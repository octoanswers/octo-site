<?php

class Categories_Query extends Abstract_Query
{
    public function categories_last_ID(): int
    {
        $stmt = $this->pdo->prepare('SELECT MAX(c_id) FROM categories');
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            throw new Exception('Error', 1);
        }

        return (int) $result['MAX(c_id)'];
    }

    public function find_newest($page = 1, $perPage = 10): array
    {
        List_Validator::validatePage($page);
        List_Validator::validatePerPage($perPage);

        $categories_last_ID = (new self($this->lang))->categories_last_ID();

        $offset = $categories_last_ID - ($perPage * $page);

        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE c_id >= :id_offset AND cat_is_redirect = 0 LIMIT :per_page');
        $stmt->bindParam(':id_offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = Category_Model::init_with_DB_state($row);
        }

        return array_reverse($categories);
    }

    public function categories_for_question_with_ID(int $questionID): array
    {
        Question_Validator::validateID($questionID);

        $stmt = $this->pdo->prepare('SELECT * FROM er_categories_questions WHERE er_question_id=:er_question_id');
        $stmt->bindParam(':er_question_id', $questionID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = (new Category_Query($this->lang))->category_with_ID($row['er_category_id']);
        }

        return $categories;
    }
}
