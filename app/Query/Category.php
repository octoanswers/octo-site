<?php

namespace Query;

class Category extends \Query\Query
{
    public function categoryWithTitle(string $category_title): ?\Model\Category
    {
        \Validator\Category::validateTitle($category_title);

        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE c_title=:c_title LIMIT 1');
        $stmt->bindParam(':c_title', $category_title, \PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        return \Model\Category::initWithDBState($row);
    }

    public function categoryWithID(int $categoryID): \Model\Category
    {
        \Validator\Category::validateID($categoryID);

        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE c_id=:c_id LIMIT 1');
        $stmt->bindParam(':c_id', $categoryID, \PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) {
            throw new \Exception('Category with ID "' . $categoryID . '" not exists', 1);
        }

        return \Model\Category::initWithDBState($row);
    }
}
