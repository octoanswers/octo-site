<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Question_Query extends Abstract_Query
{
    public function questionWithID(int $questionID): Question_Model
    {
        Question_Validator::validateID($questionID);

        $this->pdo = PDOFactory::getConnectionToLangDB($this->lang);

        $stmt = $this->pdo->prepare('SELECT * FROM questions WHERE q_id=:q_id LIMIT 1');
        $stmt->bindParam(':q_id', $questionID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception('Question with ID "'.$questionID.'" not exists', 1);
        }

        return Question_Model::initWithDBState($row);
    }

    public function questionWithTitle(string $title): Question_Model
    {
        Question_Validator::validateTitle($title);

        $this->pdo = PDOFactory::getConnectionToLangDB($this->lang);

        $stmt = $this->pdo->prepare('SELECT * FROM questions WHERE q_title=:q_title LIMIT 1');
        $stmt->bindParam(':q_title', $title, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception('Question with lang "'.$this->lang.'" and title "'.$title.'" not exists', 1);
        }

        return Question_Model::initWithDBState($row);
    }
}
