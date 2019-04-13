<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Hashtag_Query extends Abstract_Query
{
    public function topicWithID(int $hashtagID): Hashtag_Model
    {
        Topic_Validator::validateID($hashtagID);

        $stmt = $this->pdo->prepare('SELECT * FROM hashtags WHERE h_id=:h_id LIMIT 1');
        $stmt->bindParam(':h_id', $hashtagID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception('Hashtag with ID "'.$hashtagID.'" not exists', 1);
        }

        return Hashtag_Model::initWithDBState($row);
    }

    public function findWithTitle(string $title)
    {
        Topic_Validator::validateTitle($title);

        $stmt = $this->pdo->prepare('SELECT * FROM hashtags WHERE h_title=:h_title LIMIT 1');
        $stmt->bindParam(':h_title', $title, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        return Hashtag_Model::initWithDBState($row);
    }
}
