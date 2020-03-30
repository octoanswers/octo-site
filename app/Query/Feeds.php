<?php

namespace Query;

class Feeds extends \Query\Query
{
    public function findFeedsForUserWithID(int $userID): array
    {
        $user = (new \Query\User())->userWithID($userID);

        $follows_users = (new \Query\Relations\UsersFollowUsers($this->lang))->findUsersFollowedByUser($userID);
        $follows_categories = (new \Query\Relations\UsersFollowCategories($this->lang))->findCategoriesFollowedByUser($userID);
        $follows_questions = (new \Query\Relations\UsersFollowQuestions($this->lang))->findQuestionsFollowedByUser($userID);

        $where = [];
        if (count($follows_users)) {
            $where[] = '(u_id IN ('.implode(',', $follows_users).'))';
        }
        if (count($follows_categories)) {
            $where[] = '(c_id IN ('.implode(',', $follows_categories).'))';
        }
        if (count($follows_questions)) {
            $where[] = '(q_id IN ('.implode(',', $follows_questions).'))';
        }

        if (count($where) == 0) {
            return [
                'user'       => $user,
                'activities' => [],
            ];
        }

        $where_sql = implode(' OR ', $where);

        $sql = 'SELECT * FROM activities WHERE '.$where_sql.' ORDER BY id DESC LIMIT 10';

        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }
        $activities = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        //$follows_questions = [];
        foreach ($activities as &$activity) {
            unset($activity['u_id']);
            unset($activity['c_id']);
            unset($activity['q_id']);
        }

        return [
            'user_id'    => $userID,
            'sql'        => $sql,
            'activities' => $activities,
        ];
    }
}
