<?php

class UserFollowUser_Relation_Mapper extends Abstract_Mapper
{
    public function create(\Model\Relation\UserFollowUser $relation): \Model\Relation\UserFollowUser
    {
        \Validator\Relation\UserFollowUser::validate_new($relation);

        $sql = 'INSERT INTO er_users_follow_users (user_id, followed_user_id) VALUES (:user_id, :followed_user_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $relation->userID, PDO::PARAM_INT);
        $stmt->bindParam(':followed_user_id', $relation->followedUserID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $relation->id = (int) $this->pdo->lastInsertId();
        if ($relation->id === 0) {
            throw new Exception('UserFollowUser relation not saved', 1);
        }

        return $relation;
    }

    private function update(\Model\Relation\UserFollowUser $relation)
    {
        throw new Exception('UserFollowUser relation "update" method not applicable', 0);
    }

    public function delete_relation(\Model\Relation\UserFollowUser $relation): bool
    {
        \Validator\Relation\UserFollowUser::validate_exists($relation);

        $sql = 'DELETE FROM er_users_follow_users WHERE followed_user_id=:followed_user_id AND user_id=:user_id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $relation->userID, PDO::PARAM_INT);
        $stmt->bindParam(':followed_user_id', $relation->followedUserID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        if ($stmt->rowCount() == 0) {
            throw new Exception('UserFollowUser relation not deleted', 1);
        }

        return true;
    }
}
