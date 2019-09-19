<?php

namespace Mapper\Redirect;

class Question extends \Mapper\Mapper
{
    public function create(\Model\Redirect\Question $redirect): \Model\Redirect\Question
    {
        \Validator\Redirect\Question::validate($redirect);

        $sql = 'INSERT INTO redirects_questions (rd_from, rd_title) VALUES (:rd_from, :rd_title)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':rd_from', $redirect->fromID, \PDO::PARAM_INT);
        $stmt->bindParam(':rd_title', $redirect->toTitle, \PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        // @NOTE Dont get lastInsertId(), because rd_from is key field

        return $redirect;
    }
}
