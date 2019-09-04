<?php

class Contributor_Query extends Abstract_Query
{
    /**
     * @return User_Model|null
     */
    public function find_answer_last_editor(int $answerID)
    {
        Answer_Validator::validateID($answerID);

        $sql = 'SELECT * FROM revisions WHERE rev_answer_id = :answer_id ORDER BY rev_created_at DESC LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':answer_id', $answerID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return;
        }

        $userID = $row['rev_user_id'];
        $user = (new User_Query())->user_with_ID($userID);

        return $user;
    }

    /**
     * @return User_Model|null
     */
    public function find_answer_first_editor(int $answerID)
    {
        Answer_Validator::validateID($answerID);

        $sql = 'SELECT * FROM revisions WHERE rev_answer_id = :answer_id ORDER BY rev_created_at ASC LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':answer_id', $answerID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return;
        }

        $userID = $row['rev_user_id'];
        $user = (new User_Query())->user_with_ID($userID);

        return $user;
    }
}
