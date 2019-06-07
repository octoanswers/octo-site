<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Category_Query extends Abstract_Query
{
    public function categoryWithID(int $categoryID): Category
    {
        Category_Validator::validateID($categoryID);

        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE c_id=:c_id LIMIT 1');
        $stmt->bindParam(':c_id', $categoryID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception('Category with ID "'.$categoryID.'" not exists', 1);
        }

        return Category::initWithDBState($row);
    }

    public function findWithTitle(string $title)
    {
        Category_Validator::validateTitle($title);

        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE c_title=:c_title LIMIT 1');
        $stmt->bindParam(':c_title', $title, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        return Category::initWithDBState($row);
    }
}
