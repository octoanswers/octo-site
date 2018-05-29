<?php

class Redirect_Mapper extends Abstract_Mapper
{
    public function create(Redirect_Model $redirect): Redirect_Model
    {
        Redirect_Validator::validate($redirect);

        $rd_from_id = $redirect->getFromID();
        $rd_title = $redirect->getRedirectTitle();

        $sql = 'INSERT INTO redirects (rd_from, rd_title) VALUES (:rd_from, :rd_title)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':rd_from', $rd_from_id, PDO::PARAM_INT);
        $stmt->bindParam(':rd_title', $rd_title, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        // @NOTE Dont get lastInsertId(), because rd_from is key field

        return $redirect;
    }
}
