<?php

namespace Mapper\Redirect;

class Category extends \Mapper\Mapper
{
    public function create(\Model\Redirect\Category $redirect): \Model\Redirect\Category
    {
        \Validator\Redirect\Category::validate($redirect);

        $sql = 'INSERT INTO redirects_categories (rd_from, rd_title) VALUES (:rd_from, :rd_title)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':rd_from', $redirect->from_ID, \PDO::PARAM_INT);
        $stmt->bindParam(':rd_title', $redirect->to_title, \PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new \Exception($error[2], $error[1]);
        }

        // @NOTE Dont get lastInsertId(), because rd_from is key field

        return $redirect;
    }
}
