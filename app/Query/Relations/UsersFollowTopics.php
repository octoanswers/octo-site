<?php

class UsersFollowHashtags_Relations_Query extends Abstract_Query
{
    public function relationWithUserIDAndHashtagID(int $userID, int $followedHashtagID)
    {
        $sql = 'SELECT * FROM er_users_follow_hashtags WHERE user_id=:user_id AND hashtag_id=:hashtag_id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':hashtag_id', $followedHashtagID, PDO::PARAM_INT);
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
     * List of hashtags that this specific user is following.
     */
    public function findHashtagsFollowedByUser(int $userID)
    {
        $sql = 'SELECT hashtag_id FROM er_users_follow_hashtags WHERE (user_id=:user_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $follows_hashtags = [];
        foreach ($results as $row) {
            $follows_hashtags[] = (int) $row['hashtag_id'];
        }

        return $follows_hashtags;
    }
}
