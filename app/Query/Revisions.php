<?php

class Revisions_Query extends Abstract_Query
{
    public function lastRevisionForAnswerWithID(int $answerID)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM revisions WHERE rev_answer_id=:rev_answer_id  ORDER BY rev_id DESC LIMIT 1');
        $stmt->bindParam(':rev_answer_id', $answerID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return;
        }

        return Revision_Model::initWithDBState($row);
    }

    public function revisionsForAnswerWithID(int $questionID): array
    {
        Question_Validator::validateID($questionID);
        $page = 1; //QuestionsList_Validator::validatePage($page);
        $perPage = 10; //QuestionsList_Validator::validatePerPage($perPage);

        $offset = $perPage * ($page - 1);

        $questionWithIDResponce = (new Question_Query($this->lang))->questionWithID($questionID);

        $sql = 'SELECT * FROM revisions WHERE rev_answer_id = :question_id ORDER BY rev_id DESC LIMIT :id_offset, :per_page';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':question_id', $questionID, PDO::PARAM_INT);
        $stmt->bindParam(':id_offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $revisions = [];
        foreach ($rows as $row) {
            $revisions[] = Revision_Model::initWithDBState($row);
        }

        return $revisions;
    }

    public function findRevisionsForUserWithID(int $userID): array
    {
        User_Validator::validateID($userID);
        $page = 1; //QuestionsList_Validator::validatePage($page);
        $perPage = 10; //QuestionsList_Validator::validatePerPage($perPage);

        $offset = $perPage * ($page - 1);

        $user = (new User_Query())->userWithID($userID);

        $sql = 'SELECT * FROM revisions WHERE rev_user_id = :rev_user_id ORDER BY rev_id DESC LIMIT :id_offset, :per_page';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':rev_user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':id_offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $perPage, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();

            throw new Exception($error[2], $error[1]);
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $revisions = [];
        foreach ($rows as $row) {
            $revisions[] = Revision_Model::initWithDBState($row);
        }

        return $revisions;
    }
}
