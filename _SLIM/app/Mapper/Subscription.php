<?php

namespace Mapper;

class Subscription extends \Mapper\Mapper
{
    public function create(\Model\Subscription $s): \Model\Subscription
    {
        \Validator\Subscription::validateNew($s);

        $sql = 'INSERT INTO questions_subscriptions (s_email, s_question_id) VALUES (:s_email, :s_question_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':s_question_id', $s->questionID, \PDO::PARAM_INT);
        $stmt->bindParam(':s_email', $s->email, \PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $sror = $stmt->errorInfo();

            throw new \Exception($sror[2], $sror[1]);
        }

        $s->id = (int) $this->pdo->lastInsertId();
        if ($s->id === 0) {
            throw new \Exception('Subscription to question not saved', 1);
        }

        return $s;
    }

    public function update(\Model\Subscription $s): void
    {
        throw new \Exception('CategoriesQuestions ER update not realized', 1);
    }

    public function delete(\Model\Subscription $s): void
    {
        throw new \Exception('CategoriesQuestions ER delete not realized', 1);
    }
}
