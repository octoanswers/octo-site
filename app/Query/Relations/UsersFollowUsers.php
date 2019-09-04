<?php

class UsersFollowUsers_Relations_Query extends Abstract_Query
{
    public function relation_with_user_ID_and_followed_user_ID(int $userID, int $followedQuestionID)
    {
        $sql = 'SELECT * FROM er_users_follow_users WHERE user_id=:user_id AND followed_user_id=:followed_user_id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':followed_user_id', $followedQuestionID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return;
        }

        return UserFollowUser_Relation_Model::init_with_DB_state($row);
    }

    /**
     * List of users that this specific user is following.
     */
    public function find_users_followed_by_user(int $userID)
    {
        $sql = 'SELECT followed_user_id FROM er_users_follow_users WHERE (user_id=:user_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $follows_users = [];
        foreach ($results as $row) {
            $follows_users[] = (int) $row['followed_user_id'];
        }

        return $follows_users;
    }
}
