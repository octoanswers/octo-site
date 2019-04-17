<?php

class UserFollowHashtag_Relation_Mapper extends Abstract_Mapper
{
    public function create(UserFollowHashtag_Relation_Model $relation): UserFollowHashtag_Relation_Model
    {
        UserFollowHashtag_Relation_Validator::validateNew($relation);

        $userID = $relation->userID;
        $hashtagID = $relation->getHashtagID();

        $sql = 'INSERT INTO er_users_follow_hashtags (user_id, hashtag_id) VALUES (:user_id, :hashtag_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':hashtag_id', $hashtagID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $relationID = (int) $this->pdo->lastInsertId();
        $relation->setID($relationID);
        if ($relation->getID() === 0) {
            throw new Exception('UserFollowHashtag relation not saved', 1);
        }

        return $relation;
    }

    private function update(UserFollowHashtag_Relation_Model $relation)
    {
        throw new Exception('UserFollowHashtag relation "update" method not applicable', 0);
    }

    public function deleteRelation(UserFollowHashtag_Relation_Model $relation): bool
    {
        UserFollowHashtag_Relation_Validator::validateExists($relation);

        $userID = $relation->userID;
        $hashtagID = $relation->getHashtagID();

        $sql = 'DELETE FROM er_users_follow_hashtags WHERE hashtag_id=:hashtag_id AND user_id=:user_id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':hashtag_id', $hashtagID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $deleted_rows = $stmt->rowCount();
        if ($deleted_rows == 0) {
            throw new Exception("UserFollowHashtag relation not deleted", 1);
        }

        return true;
    }
}
