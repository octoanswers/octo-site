<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Flow_Query extends Abstract_Query
{
    public function findFlow(): array
    {
        $sql = 'SELECT * FROM activities ORDER BY id DESC LIMIT 10';

        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }
        $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //$follows_questions = [];
        foreach ($activities as &$activity) {
            unset($activity['u_id']);
            unset($activity['c_id']);
            unset($activity['q_id']);
        }

        return $activities;
    }
}
