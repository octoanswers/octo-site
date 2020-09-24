<?php

namespace Mapper;

class Answer extends Mapper
{
    public function update(\Model\Answer $answer): \Model\Answer
    {
        \Validator\Answer::validate($answer);

        $anaswerLenght = mb_strlen($answer->text);

        $sql = 'UPDATE questions SET a_text=:a_text, a_len=:a_len, a_updated_at=:a_updated_at WHERE q_id=:q_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':q_id', $answer->id, \PDO::PARAM_INT);
        $stmt->bindParam(':a_text', $answer->text, \PDO::PARAM_STR);
        $stmt->bindParam(':a_len', $anaswerLenght, \PDO::PARAM_INT);
        $stmt->bindParam(':a_updated_at', $answer->updatedAt, \PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }
        $count = $stmt->rowCount();
        if ($count == 0) {
            throw new \Exception('Answer with ID ' . $answer->id . ' not updated', 0);
        }

        return $answer;
    }
}
