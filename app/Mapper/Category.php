<?php

class Category_Mapper extends Abstract_Mapper
{
    public function create(Category_Model $category): Category_Model
    {
        Category_Validator::validateNew($category);

        $sql = 'INSERT INTO categories (c_title, cat_is_redirect) VALUES (:c_title, :cat_is_redirect)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':c_title', $category->title, PDO::PARAM_STR);
        $stmt->bindParam(':cat_is_redirect', $category->isRedirect, PDO::PARAM_INT);

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

    public function update(Category_Model $category): Category_Model
    {
        Category_Validator::validate_exists($category);

        $sql = 'UPDATE categories SET c_title=:c_title, cat_is_redirect=:cat_is_redirect WHERE c_id=:c_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':c_id', $category->id, PDO::PARAM_INT);
        $stmt->bindParam(':c_title', $category->title, PDO::PARAM_STR);
        $stmt->bindParam(':cat_is_redirect', $category->isRedirect, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        if ($stmt->rowCount() == 0) {
            throw new Exception('Category with ID ' . $category->id . ' not exists', 0);
        }

        return $category;
    }
}
