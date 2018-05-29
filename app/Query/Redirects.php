<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Redirects_Query extends Abstract_Query
{
    public function redirectForQuestionWithID(int $questionID): Redirect_Model
    {
        Question_Validator::validateID($questionID);

        $stmt = $this->pdo->prepare('SELECT * FROM redirects WHERE rd_from=:rd_from LIMIT 1');
        $stmt->bindParam(':rd_from', $questionID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception('Redirect for question with ID "'.$questionID.'" not exists', 1);
        }

        return Redirect_Model::initWithDBState($row);
    }
}
