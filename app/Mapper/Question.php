<?php

class Question_Mapper extends Abstract_Mapper
{
    public function create(Question_Model $question): Question_Model
    {
        Question_Validator::validateNew($question);

        $q_title = $question->title;
        $q_is_redirect = $question->isRedirect() ? 1 : 0;
        $q_image_base_name = $question->imageBaseName;

        $sql = 'INSERT INTO questions (q_title, q_is_redirect, q_image_base_name) VALUES (:q_title, :q_is_redirect, :q_image_base_name)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':q_title', $q_title, PDO::PARAM_STR);
        $stmt->bindParam(':q_is_redirect', $q_is_redirect, PDO::PARAM_INT);
        $stmt->bindParam(':q_image_base_name', $q_image_base_name, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $questionID = (int) $this->pdo->lastInsertId();
        $question->setID($questionID);
        if ($question->getID() === 0) {
            throw new Exception('Question not saved', 1);
        }

        return $question;
    }

    public function update(Question_Model $question): Question_Model
    {
        Question_Validator::validateExists($question);

        $q_id = $question->getID();
        $q_title = $question->title;
        $q_is_redirect = $question->isRedirect() ? 1 : 0;
        $q_image_base_name = $question->imageBaseName;

        $sql = 'UPDATE questions SET q_title=:q_title, q_is_redirect=:q_is_redirect, q_image_base_name=:q_image_base_name WHERE q_id=:q_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':q_id', $q_id, PDO::PARAM_INT);
        $stmt->bindParam(':q_title', $q_title, PDO::PARAM_STR);
        $stmt->bindParam(':q_is_redirect', $q_is_redirect, PDO::PARAM_INT);
        $stmt->bindParam(':q_image_base_name', $q_image_base_name, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }
        $count = $stmt->rowCount();
        if ($count == 0) {
            throw new Exception('Question with ID '.$q_id.' not exists', 0);
        }

        return $question;
    }

    public function updateHashtags(Question_Model $question): Question_Model
    {
        Question_Validator::validateID($question->getID());
        Question_Validator::validateHashtags($question->getHashtags());

        if ($question->getHashtagsJSON() === null) {
            return $question;
        }

        $q_id = $question->getID();
        $hashtags_array = $question->getHashtags();

        $hashtags_json = json_encode($hashtags_array, JSON_UNESCAPED_UNICODE);

        $sql = 'UPDATE questions SET a_hashtags=:a_hashtags WHERE q_id=:q_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':q_id', $q_id, PDO::PARAM_INT);
        $stmt->bindParam(':a_hashtags', $hashtags_json, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }
        $count = $stmt->rowCount();
        if ($count == 0) {
            throw new Exception('Question with ID '.$q_id.' not saved', 0);
        }

        return $question;
    }
}
