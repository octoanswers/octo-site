<?php

class Revision_Mapper extends Abstract_Mapper
{
    public function save(Revision_Model $revision): Revision_Model
    {
        Revision_Validator::validate($revision);

        if (is_int($revision->id)) {
            $sql = 'UPDATE revisions SET rev_answer_id=:rev_answer_id, rev_opcodes=:rev_opcodes, rev_base_text=:rev_base_text, rev_comment=:rev_comment, rev_user_id=:rev_user_id, rev_parent_id=:rev_parent_id WHERE rev_id=:rev_id';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':rev_id', $revision->id, PDO::PARAM_INT);
            $stmt->bindParam(':rev_answer_id', $revision->answerID, PDO::PARAM_INT);
            $stmt->bindParam(':rev_opcodes', $revision->opcodes, PDO::PARAM_STR);
            $stmt->bindParam(':rev_base_text', $revision->baseText, PDO::PARAM_STR);
            $stmt->bindParam(':rev_comment', $revision->comment, PDO::PARAM_STR);
            $stmt->bindParam(':rev_parent_id', $revision->parentID, PDO::PARAM_INT);
            $stmt->bindParam(':rev_user_id', $revision->userID, PDO::PARAM_INT);
            
            if (!$stmt->execute()) {
                $error = $stmt->errorInfo();
                throw new Exception($error[2], $error[1]);
            }
        } else {
            $sql = 'INSERT INTO revisions (rev_answer_id, rev_opcodes, rev_base_text, rev_comment, rev_user_id, rev_parent_id) VALUES (:rev_answer_id, :rev_opcodes, :rev_base_text, :rev_comment, :rev_user_id, :rev_parent_id)';
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->bindParam(':rev_answer_id', $revision->answerID, PDO::PARAM_INT);
            $stmt->bindParam(':rev_opcodes', $revision->opcodes, PDO::PARAM_STR);
            $stmt->bindParam(':rev_base_text', $revision->baseText, PDO::PARAM_STR);
            $stmt->bindParam(':rev_comment', $revision->comment, PDO::PARAM_STR);
            $stmt->bindParam(':rev_parent_id', $revision->parentID, PDO::PARAM_INT);
            $stmt->bindParam(':rev_user_id', $revision->userID, PDO::PARAM_INT);
            
            if (!$stmt->execute()) {
                $error = $stmt->errorInfo();
                throw new Exception($error[2], $error[1]);
            }

            $now = new DateTime('NOW');
            $revision->createdAt = $now->format('Y-m-d H:i:s');

            $revision->id = (int) $this->pdo->lastInsertId();
            if ($revision->id === 0) {
                throw new Exception('Revision not saved', 1);
            }
        }

        return $revision;
    }
}
