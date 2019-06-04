<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Feeds_Query extends Abstract_Query
{
    public function findFeedsForUserWithID(int $userID): array
    {
        $user = (new User_Query())->userWithID($userID);

        $follows_users = (new UsersFollowUsers_Relations_Query($this->lang))->findUsersFollowedByUser($userID);
        $follows_categories = (new UsersFollowCategories_Relations_Query($this->lang))->findCategoriesFollowedByUser($userID);
        $follows_questions = (new UsersFollowQuestions_Relations_Query($this->lang))->findQuestionsFollowedByUser($userID);

        $where = [];
        if (count($follows_users)) {
            $where[] = '(u_id IN ('.implode(',', $follows_users).'))';
        }
        if (count($follows_categories)) {
            $where[] = '(h_id IN ('.implode(',', $follows_categories).'))';
        }
        if (count($follows_questions)) {
            $where[] = '(q_id IN ('.implode(',', $follows_questions).'))';
        }

        if (count($where) == 0) {
            return [
                'user' => $user,
                'activities' => [],
            ];
        }

        $where_sql = implode(' OR ', $where);

        $sql = 'SELECT * FROM activities WHERE '.$where_sql.' ORDER BY id DESC LIMIT 10';

        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }
        $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //$follows_questions = [];
        foreach ($activities as &$activity) {
            unset($activity['u_id']);
            unset($activity['h_id']);
            unset($activity['q_id']);
        }

        return [
            'user_id' => $userID,
            'sql' => $sql,
            'activities' => $activities,
        ];

        // read feed file
        // $feed_file = DATA_DIR.'/users/'.$user['id'].'/_feed.json';
        // if (file_exists($feed_file)) {
        //     $json_string = file_get_contents($feed_file);
        //     $items = json_decode($json_string, true);
        //
        //     if (json_last_error()) {
        //         throw new Exception(json_last_error_msg(), json_last_error());
        //     }
        //
        //     $response['items'] = $items;
        // } else {
        //     $response['error_code'] = 1;
        //     $response['error_message'] = 'Not found feed file '.$feed_file;
        // }
    }
}
