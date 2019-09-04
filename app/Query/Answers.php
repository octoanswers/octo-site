<?php

class Answers_Query extends Abstract_Query
{
    public function answer_with_ID(int $answerID)
    {
        Answer_Validator::validateID($answerID);

        $this->pdo = PDOFactory::get_connection_to_lang_DB($this->lang);

        $stmt = $this->pdo->prepare('SELECT * FROM questions WHERE q_id=:q_id LIMIT 1');
        $stmt->bindParam(':q_id', $answerID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return;
        }

        return Answer_Model::init_with_DB_state($row);
    }
}
