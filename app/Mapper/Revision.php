<?php

class Revision_Mapper extends Abstract_Mapper
{
    public function save(Revision_Model $revision): Revision_Model
    {
        Revision_Validator::validate($revision);

        $rev_id = $revision->getID();
        $rev_answer_id = $revision->getAnswerID();
        $rev_opcodes = $revision->getOpcodes();
        $rev_base_text = $revision->getBaseText();
        $rev_comment = $revision->getComment();
        $rev_parent_id = $revision->getParentID();
        $rev_user_id = $revision->getUserID();

        if (is_int($rev_id)) {
            $sql = 'UPDATE revisions SET rev_answer_id=:rev_answer_id, rev_opcodes=:rev_opcodes, rev_base_text=:rev_base_text, rev_comment=:rev_comment, rev_user_id=:rev_user_id, rev_parent_id=:rev_parent_id WHERE rev_id=:rev_id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':rev_id', $rev_id, PDO::PARAM_INT);
            $stmt->bindParam(':rev_answer_id', $rev_answer_id, PDO::PARAM_INT);
            $stmt->bindParam(':rev_opcodes', $rev_opcodes, PDO::PARAM_STR);
            $stmt->bindParam(':rev_base_text', $rev_base_text, PDO::PARAM_STR);
            $stmt->bindParam(':rev_comment', $rev_comment, PDO::PARAM_STR);
            $stmt->bindParam(':rev_parent_id', $rev_parent_id, PDO::PARAM_INT);
            $stmt->bindParam(':rev_user_id', $rev_user_id, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                $error = $stmt->errorInfo();
                throw new Exception($error[2], $error[1]);
            }
        } else {
            $sql = 'INSERT INTO revisions (rev_answer_id, rev_opcodes, rev_base_text, rev_comment, rev_user_id, rev_parent_id) VALUES (:rev_answer_id, :rev_opcodes, :rev_base_text, :rev_comment, :rev_user_id, :rev_parent_id)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':rev_answer_id', $rev_answer_id, PDO::PARAM_INT);
            $stmt->bindParam(':rev_opcodes', $rev_opcodes, PDO::PARAM_STR);
            $stmt->bindParam(':rev_base_text', $rev_base_text, PDO::PARAM_STR);
            $stmt->bindParam(':rev_comment', $rev_comment, PDO::PARAM_STR);
            $stmt->bindParam(':rev_parent_id', $rev_parent_id, PDO::PARAM_INT);
            $stmt->bindParam(':rev_user_id', $rev_user_id, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                $error = $stmt->errorInfo();
                throw new Exception($error[2], $error[1]);
            }

            $now = new DateTime('NOW');
            $revision->createdAt = $now->format('Y-m-d H:i:s');

            $revisionID = (int) $this->pdo->lastInsertId();
            $revision->setID($revisionID);
            if ($revisionID === 0) {
                throw new Exception('Revision not saved', 1);
            }
        }

        return $revision;
    }
}
