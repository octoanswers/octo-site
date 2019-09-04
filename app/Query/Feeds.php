<?php

class Feeds_Query extends Abstract_Query
{
    public function find_feeds_for_user_with_ID(int $userID): array
    {
        $user = (new User_Query())->user_with_ID($userID);

        $follows_users = (new UsersFollowUsers_Relations_Query($this->lang))->find_users_followed_by_user($userID);
        $follows_categories = (new UsersFollowCategories_Relations_Query($this->lang))->find_categories_followed_by_user($userID);
        $follows_questions = (new UsersFollowQuestions_Relations_Query($this->lang))->find_questions_followed_by_user($userID);

        $where = [];
        if (count($follows_users)) {
            $where[] = '(u_id IN (' . implode(',', $follows_users) . '))';
        }
        if (count($follows_categories)) {
            $where[] = '(c_id IN (' . implode(',', $follows_categories) . '))';
        }
        if (count($follows_questions)) {
            $where[] = '(q_id IN (' . implode(',', $follows_questions) . '))';
        }

        if (count($where) == 0) {
            return [
                'user'       => $user,
                'activities' => [],
            ];
        }

        $where_sql = implode(' OR ', $where);

        $sql = 'SELECT * FROM activities WHERE ' . $where_sql . ' ORDER BY id DESC LIMIT 10';

        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
