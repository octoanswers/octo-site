<?php

class UsersFollowTopics_Relations_Query extends Abstract_Query
{
    public function relationWithUserIDAndTopicID(int $userID, int $followedTopicID)
    {
        $sql = 'SELECT * FROM er_users_follow_topics WHERE user_id=:user_id AND topic_id=:topic_id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':topic_id', $followedTopicID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return null;
        }

        return UserFollowHashtag_Relation_Model::initWithDBState($row);
    }

    /**
     * List of topics that this specific user is following.
     */
    function findTopicsFollowedByUser(int $userID)
    {
        $sql = 'SELECT topic_id FROM er_users_follow_topics WHERE (user_id=:user_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $follows_topics = [];
        foreach ($results as $row) {
            $follows_topics[] = (int) $row['topic_id'];
        }

        return $follows_topics;
    }
}
