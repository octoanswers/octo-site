<?php

namespace Query;

class Categories extends \Query\Query
{
    public function categoriesLastID(): int
    {
        $stmt = $this->pdo->prepare('SELECT MAX(c_id) FROM categories');
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            throw new \Exception('Error', 1);
        }

        return (int) $result['MAX(c_id)'];
    }

    public function findNewest($page = 1, $perPage = 10): array
    {
        \Validator\SearchList::validatePage($page);
        \Validator\SearchList::validatePerPage($perPage);

        $categoriesLastID = (new self($this->lang))->categoriesLastID();

        $offset = $categoriesLastID - ($perPage * $page);

        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE c_id >= :id_offset AND cat_is_redirect = 0 LIMIT :per_page');
        $stmt->bindParam(':id_offset', $offset, \PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = \Model\Category::initWithDBState($row);
        }

        return array_reverse($categories);
    }

    public function categoriesForQuestionWithID(int $questionID): array
    {
        \Validator\Question::validateID($questionID);

        $stmt = $this->pdo->prepare('SELECT * FROM er_categories_questions WHERE er_question_id=:er_question_id');
        $stmt->bindParam(':er_question_id', $questionID, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = (new \Query\Category($this->lang))->categoryWithID($row['er_category_id']);
        }

        return $categories;
    }
}
