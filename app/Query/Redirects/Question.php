<?php

class Question_Redirects_Query extends Abstract_Query
{
    public function redirect_for_question_with_ID(int $questionID): \Model\Redirect\Question
    {
        Question_Validator::validateID($questionID);

        $stmt = $this->pdo->prepare('SELECT * FROM redirects_questions WHERE rd_from=:rd_from LIMIT 1');
        $stmt->bindParam(':rd_from', $questionID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception('Redirect for question with ID "' . $questionID . '" not exists', 1);
        }

        return \Model\Redirect\Question::init_with_DB_state($row);
    }
}
