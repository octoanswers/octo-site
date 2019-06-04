<?php

class Category_Mapper extends Abstract_Mapper
{
    public function create(Category $category): Category
    {
        Category_Validator::validateNew($category);

        $sql = 'INSERT INTO categories (h_title) VALUES (:h_title)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':h_title', $category->title, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $category->id = (int) $this->pdo->lastInsertId();
        if ($category->id === 0) {
            throw new Exception('Category not saved', 1);
        }

        return $category;
    }

    public function update(Category $category): Category
    {
        Category_Validator::validateExists($category);

        $sql = 'UPDATE categories SET h_title=:h_title WHERE h_id=:h_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':h_id', $category->id, PDO::PARAM_INT);
        $stmt->bindParam(':h_title', $category->title, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        if ($stmt->rowCount() == 0) {
            throw new Exception('Category with ID '.$category->id.' not exists', 0);
        }

        return $category;
    }
}
