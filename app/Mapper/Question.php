<?php

class Question_Mapper extends Abstract_Mapper
{
    public function create(Question_Model $question): Question_Model
    {
        Question_Validator::validate_new($question);

        $sql = 'INSERT INTO questions (q_title, q_is_redirect, q_image_base_name) VALUES (:q_title, :q_is_redirect, :q_image_base_name)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':q_title', $question->title, PDO::PARAM_STR);
        $stmt->bindParam(':q_is_redirect', $question->isRedirect, PDO::PARAM_BOOL);
        $stmt->bindParam(':q_image_base_name', $question->imageBaseName, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $question->id = (int) $this->pdo->lastInsertId();
        if ($question->id === 0) {
            throw new Exception('Question not saved', 1);
        }

        return $question;
    }

    public function update(Question_Model $question): Question_Model
    {
        Question_Validator::validate_exists($question);

        $sql = 'UPDATE questions SET q_title=:q_title, q_is_redirect=:q_is_redirect, q_image_base_name=:q_image_base_name WHERE q_id=:q_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':q_id', $question->id, PDO::PARAM_INT);
        $stmt->bindParam(':q_title', $question->title, PDO::PARAM_STR);
        $stmt->bindParam(':q_is_redirect', $question->isRedirect, PDO::PARAM_INT);
        $stmt->bindParam(':q_image_base_name', $question->imageBaseName, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        $count = $stmt->rowCount();
        if ($count == 0) {
            throw new Exception('Question with ID ' . $question->id . ' not exists', 0);
        }

        return $question;
    }

    public function updateCategoriesCount(Question_Model $question): Question_Model
    {
        if ($question->categoriesCount == null) {
            $question->categoriesCount = 0;
        }

        Question_Validator::validateID($question->id);
        Question_Validator::validateCategoriesCount($question->categoriesCount);

        $sql = 'UPDATE questions SET count_categories=:count_categories WHERE q_id=:q_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':q_id', $question->id, PDO::PARAM_INT);
        $stmt->bindParam(':count_categories', $question->categoriesCount, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        return $question;
    }
}
