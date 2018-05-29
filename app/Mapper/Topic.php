<?php

class Topic_Mapper extends Abstract_Mapper
{
    public function create(Topic_Model $topic): Topic_Model
    {
        Topic_Validator::validateNew($topic);

        $t_title = $topic->getTitle();

        $sql = 'INSERT INTO topics (t_title) VALUES (:t_title)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':t_title', $t_title, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $topicID = (int) $this->pdo->lastInsertId();
        $topic->setID($topicID);
        if ($topic->getID() === 0) {
            throw new Exception('Topic not saved', 1);
        }

        return $topic;
    }

    public function update(Topic_Model $topic): Topic_Model
    {
        Topic_Validator::validateExists($topic);

        $t_id = $topic->getID();
        $t_title = $topic->getTitle();

        $sql = 'UPDATE topics SET t_title=:t_title WHERE t_id=:t_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':t_id', $t_id, PDO::PARAM_INT);
        $stmt->bindParam(':t_title', $t_title, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }
        $count = $stmt->rowCount();
        if ($count == 0) {
            throw new Exception('Topic with ID '.$t_id.' not exists', 0);
        }

        return $topic;
    }
}
