<?php

class Subscription_Mapper extends Abstract_Mapper
{
    public function create(Subscription_Model $s): Subscription_Model
    {
        Subscription_Validator::validateNew($s);

        $sql = 'INSERT INTO questions_subscriptions (s_email, s_question_id) VALUES (:s_email, :s_question_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':s_question_id', $s->questionID, PDO::PARAM_INT);
        $stmt->bindParam(':s_email', $s->email, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $sror = $stmt->errorInfo();

            throw new Exception($sror[2], $sror[1]);
        }

        $s->id = (int) $this->pdo->lastInsertId();
        if ($s->id === 0) {
            throw new Exception('Subscription to question not saved', 1);
        }

        return $s;
    }

    private function update(CategoriesToQuestions_Relation_Model $s): CategoriesToQuestions_Relation_Model
    {
        // We don`t need to update ER
        return $s;
    }

    public function delete(CategoriesToQuestions_Relation_Model $s): CategoriesToQuestions_Relation_Model
    {
        throw new Exception('CategoriesQuestions ER delete not realized', 1);
    }
}
