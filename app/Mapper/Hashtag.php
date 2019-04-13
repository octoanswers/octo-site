<?php

class Hashtag_Mapper extends Abstract_Mapper
{
    public function create(Hashtag_Model $topic): Hashtag_Model
    {
        Topic_Validator::validateNew($topic);

        $hashtagTitle = $topic->getTitle();

        $sql = 'INSERT INTO hashtags (h_title) VALUES (:h_title)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':h_title', $hashtagTitle, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $hashtagID = (int) $this->pdo->lastInsertId();
        $topic->setID($hashtagID);
        if ($topic->getID() === 0) {
            throw new Exception('Hashtag not saved', 1);
        }

        return $topic;
    }

    public function update(Hashtag_Model $topic): Hashtag_Model
    {
        Topic_Validator::validateExists($topic);

        $hashtagID = $topic->getID();
        $hashtagTitle = $topic->getTitle();

        $sql = 'UPDATE hashtags SET h_title=:h_title WHERE h_id=:h_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':h_id', $hashtagID, PDO::PARAM_INT);
        $stmt->bindParam(':h_title', $hashtagTitle, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }
        $count = $stmt->rowCount();
        if ($count == 0) {
            throw new Exception('Hashtag with ID '.$hashtagID.' not exists', 0);
        }

        return $topic;
    }
}
