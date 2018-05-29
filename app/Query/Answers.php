<?php

class Answers_Query extends Abstract_Query
{
    public function answerWithID(int $answerID)
    {
        Answer_Validator::validateID($answerID);

        $this->pdo = PDOFactory::getConnectionToLangDB($this->lang);

        $stmt = $this->pdo->prepare('SELECT * FROM questions WHERE q_id=:q_id LIMIT 1');
        $stmt->bindParam(':q_id', $answerID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }
        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return null;
        }

        return Answer_Model::initWithDBState($row);
    }
}
