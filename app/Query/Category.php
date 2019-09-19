<?php

class Category_Query extends Abstract_Query
{
    public function category_with_title(string $categoryTitle): \Model\Category
    {
        \Validator\Category::validate_title($categoryTitle);

        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE c_title=:c_title LIMIT 1');
        $stmt->bindParam(':c_title', $categoryTitle, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception('Category with lang "' . $this->lang . '" and title "' . $categoryTitle . '" not exists', 1);
        }

        return \Model\Category::init_with_DB_state($row);
    }

    public function category_with_ID(int $categoryID): \Model\Category
    {
        \Validator\Category::validateID($categoryID);

        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE c_id=:c_id LIMIT 1');
        $stmt->bindParam(':c_id', $categoryID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception('Category with ID "' . $categoryID . '" not exists', 1);
        }

        return \Model\Category::init_with_DB_state($row);
    }

    public function find_with_title(string $title)
    {
        \Validator\Category::validate_title($title);

        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE c_title=:c_title LIMIT 1');
        $stmt->bindParam(':c_title', $title, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return;
        }

        return \Model\Category::init_with_DB_state($row);
    }
}
