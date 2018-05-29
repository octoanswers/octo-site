<?php

class UserFollowUser_Relation_Mapper extends Abstract_Mapper
{
    public function create(UserFollowUser_Relation_Model $relation): UserFollowUser_Relation_Model
    {
        UserFollowUser_Relation_Validator::validateNew($relation);

        $userID = $relation->getUserID();
        $followedUserID = $relation->getFollowedUserID();

        $sql = 'INSERT INTO er_users_follow_users (user_id, followed_user_id) VALUES (:user_id, :followed_user_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':followed_user_id', $followedUserID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $relationID = (int) $this->pdo->lastInsertId();
        $relation->setID($relationID);
        if ($relation->getID() === 0) {
            throw new Exception('UserFollowUser relation not saved', 1);
        }

        return $relation;
    }

    private function update(UserFollowUser_Relation_Model $relation)
    {
        throw new Exception('UserFollowUser relation "update" method not applicable', 0);
    }

    public function deleteRelation(UserFollowUser_Relation_Model $relation): bool
    {
        UserFollowUser_Relation_Validator::validateExists($relation);

        $userID = $relation->getUserID();
        $followedUserID = $relation->getFollowedUserID();

        $sql = 'DELETE FROM er_users_follow_users WHERE followed_user_id=:followed_user_id AND user_id=:user_id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':followed_user_id', $followedUserID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $deleted_rows = $stmt->rowCount();
        if ($deleted_rows == 0) {
            throw new Exception("UserFollowUser relation not deleted", 1);
        }

        return true;
    }
}
