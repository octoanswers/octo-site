<?php

class Redirect_Mapper extends Abstract_Mapper
{
    public function create(Redirect_Model $redirect): Redirect_Model
    {
        Redirect_Validator::validate($redirect);

        $fromID = $redirect->fromID;
        $toTitle = $redirect->toTitle;

        $sql = 'INSERT INTO redirects (rd_from, rd_title) VALUES (:rd_from, :rd_title)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':rd_from', $fromID, PDO::PARAM_INT);
        $stmt->bindParam(':rd_title', $toTitle, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        // @NOTE Dont get lastInsertId(), because rd_from is key field

        return $redirect;
    }
}
