<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Topic_Query extends Abstract_Query
{
    public function topicWithID(int $topicID): Topic_Model
    {
        Topic_Validator::validateID($topicID);

        $stmt = $this->pdo->prepare('SELECT * FROM topics WHERE t_id=:t_id LIMIT 1');
        $stmt->bindParam(':t_id', $topicID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception('Topic with ID "'.$topicID.'" not exists', 1);
        }

        return Topic_Model::initWithDBState($row);
    }

    public function findWithTitle(string $title)
    {
        Topic_Validator::validateTitle($title);

        $stmt = $this->pdo->prepare('SELECT * FROM topics WHERE t_title=:t_title LIMIT 1');
        $stmt->bindParam(':t_title', $title, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        return Topic_Model::initWithDBState($row);
    }
}
