<?php

namespace Query;

class Question extends \Query\Query
{
    public function questionWithTitle(string $title): \Model\Question
    {
        \Validator\Question::validateTitle($title);

        $this->pdo = \Helper\PDOFactory::getConnectionToLangDB($this->lang);

        $stmt = $this->pdo->prepare('SELECT * FROM questions WHERE q_title=:q_title LIMIT 1');
        $stmt->bindParam(':q_title', $title, \PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) {
            throw new \Exception('Question with lang "' . $this->lang . '" and title "' . $title . '" not exists', 1);
        }

        return \Model\Question::initWithDBState($row);
    }

    public function questionWithID(int $questionID): \Model\Question
    {
        \Validator\Question::validateID($questionID);

        $this->pdo = \Helper\PDOFactory::getConnectionToLangDB($this->lang);

        $stmt = $this->pdo->prepare('SELECT * FROM questions WHERE q_id=:q_id LIMIT 1');
        $stmt->bindParam(':q_id', $questionID, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) {
            throw new \Exception('Question with ID "' . $questionID . '" not exists', 1);
        }

        return \Model\Question::initWithDBState($row);
    }
}
