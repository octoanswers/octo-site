<?php

class HashtagToQuestion_Relation_Mapper extends Abstract_Mapper
{
    public function create(HashtagsToQuestions_Relation_Model $er): HashtagsToQuestions_Relation_Model
    {
        HashtagToQuestion_Relation_Validator::validateNew($er);

        $sql = 'INSERT INTO er_hashtags_questions (er_hashtag_id, er_question_id) VALUES (:er_hashtag_id, :er_question_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':er_hashtag_id', $er->hashtagID, PDO::PARAM_INT);
        $stmt->bindParam(':er_question_id', $er->questionID, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $er->id = (int) $this->pdo->lastInsertId();
        if ($er->id === 0) {
            throw new Exception('HashtagsQuestions ER not saved', 1);
        }

        return $er;
    }

    private function update(HashtagsToQuestions_Relation_Model $er): HashtagsToQuestions_Relation_Model
    {
        // We don`t need to update ER
        return $er;
    }

    public function delete(HashtagsToQuestions_Relation_Model $er): HashtagsToQuestions_Relation_Model
    {
        throw new Exception('HashtagsQuestions ER delete not realized', 1);
    }
}
