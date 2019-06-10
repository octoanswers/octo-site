<?php

class Category_Redirect_Mapper extends Abstract_Mapper
{
    public function create(Category_Redirect_Model $redirect): Category_Redirect_Model
    {
        Category_Redirect_Validator::validate($redirect);

        $sql = 'INSERT INTO redirects_categories (rd_from, rd_title) VALUES (:rd_from, :rd_title)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':rd_from', $redirect->fromID, PDO::PARAM_INT);
        $stmt->bindParam(':rd_title', $redirect->toTitle, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        // @NOTE Dont get lastInsertId(), because rd_from is key field

        return $redirect;
    }
}
