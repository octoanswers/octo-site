<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Question_Redirects_Query extends Abstract_Query
{
    public function redirectForQuestionWithID(int $questionID): Question_Redirect_Model
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
            throw new Exception('Redirect for question with ID "'.$questionID.'" not exists', 1);
        }

        return Question_Redirect_Model::initWithDBState($row);
    }
}
