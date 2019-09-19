<?php

namespace Query\Relations;

class CategoriesToQuestions extends \Query\Query
{
    const QUESTIONS_PER_PAGE = 10; // @TODO double

    public function find_newest_for_category_with_ID(int $categoryID, int $page = 1, int $per_page = 10): array
    {
        \Validator\Relation\CategoryToQuestion::validateCategoryID($categoryID);
        \Validator\QuestionsList::validatePage($page);
        \Validator\QuestionsList::validatePerPage($per_page);

        $offset = $per_page * ($page - 1);

        $stmt = $this->pdo->prepare('SELECT * FROM `er_categories_questions` WHERE er_category_id = :er_category_id ORDER BY er_id DESC LIMIT :id_offset, :per_page');
        $stmt->bindParam(':er_category_id', $categoryID, \PDO::PARAM_INT);
        $stmt->bindParam(':id_offset', $offset, \PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $per_page, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $ERs = [];
        foreach ($rows as $row) {
            $ERs[] = \Model\Relation\CategoriesToQuestions::init_with_DB_state($row);
        }

        return $ERs;
    }

    public function find_by_category_ID_and_question_ID(int $categoryID, int $question_id)
    {
        \Validator\Relation\CategoryToQuestion::validateCategoryID($categoryID);
        \Validator\Relation\CategoryToQuestion::validateQuestionID($question_id);

        $stmt = $this->pdo->prepare('SELECT * FROM er_categories_questions WHERE er_category_id=:er_category_id AND er_question_id=:er_question_id LIMIT 1');
        $stmt->bindParam(':er_category_id', $categoryID, \PDO::PARAM_INT);
        $stmt->bindParam(':er_question_id', $question_id, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) {
            return;
        }

        return \Model\Relation\CategoriesToQuestions::init_with_DB_state($row);
    }

    public function find_by_category_title_and_question_ID(string $category_title, int $question_id)
    {
        \Validator\Category::validate_title($category_title);
        \Validator\Relation\CategoryToQuestion::validateQuestionID($question_id);

        $category = (new \Query\Category($this->lang))->find_with_title($category_title);
        if ($category === null) {
            return;
        }

        return (new self($this->lang))->find_by_category_ID_and_question_ID($category->id, $question_id);
    }
}
