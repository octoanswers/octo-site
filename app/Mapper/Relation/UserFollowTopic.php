<?php

class UserFollowTopic_Relation_Mapper extends Abstract_Mapper
{
    public function create(UserFollowTopic_Relation_Model $relation): UserFollowTopic_Relation_Model
    {
        UserFollowTopic_Relation_Validator::validateNew($relation);

        $userID = $relation->getUserID();
        $topicID = $relation->getTopicID();

        $sql = 'INSERT INTO er_users_follow_topics (user_id, topic_id) VALUES (:user_id, :topic_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':topic_id', $topicID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $relationID = (int) $this->pdo->lastInsertId();
        $relation->setID($relationID);
        if ($relation->getID() === 0) {
            throw new Exception('UserFollowTopic relation not saved', 1);
        }

        return $relation;
    }

    private function update(UserFollowTopic_Relation_Model $relation)
    {
        throw new Exception('UserFollowTopic relation "update" method not applicable', 0);
    }

    public function deleteRelation(UserFollowTopic_Relation_Model $relation): bool
    {
        UserFollowTopic_Relation_Validator::validateExists($relation);

        $userID = $relation->getUserID();
        $topicID = $relation->getTopicID();

        $sql = 'DELETE FROM er_users_follow_topics WHERE topic_id=:topic_id AND user_id=:user_id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':topic_id', $topicID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $deleted_rows = $stmt->rowCount();
        if ($deleted_rows == 0) {
            throw new Exception("UserFollowTopic relation not deleted", 1);
        }

        return true;
    }
}
