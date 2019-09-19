<?php

class CategoryToQuestion_Relation_Mapper extends Abstract_Mapper
{
    public function create(\Model\Relation\CategoriesToQuestions $er): \Model\Relation\CategoriesToQuestions
    {
        CategoryToQuestion_Relation_Validator::validate_new($er);

        $sql = 'INSERT INTO er_categories_questions (er_category_id, er_question_id) VALUES (:er_category_id, :er_question_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':er_category_id', $er->categoryID, PDO::PARAM_INT);
        $stmt->bindParam(':er_question_id', $er->questionID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $er->id = (int) $this->pdo->lastInsertId();
        if ($er->id === 0) {
            throw new Exception('CategoriesQuestions ER not saved', 1);
        }

        return $er;
    }

    private function update(\Model\Relation\CategoriesToQuestions $er): \Model\Relation\CategoriesToQuestions
    {
        // We don`t need to update ER
        return $er;
    }

    public function delete(\Model\Relation\CategoriesToQuestions $er): void
    {
        throw new Exception('CategoriesQuestions ER delete not realized', 1);
    }
}
