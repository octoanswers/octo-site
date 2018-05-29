<?php

class TopicToQuestion_Relation_Mapper extends Abstract_Mapper
{
    public function create(TopicsToQuestions_Relation_Model $er): TopicsToQuestions_Relation_Model
    {
        TopicToQuestion_Relation_Validator::validateNew($er);

        $er_topic_id = $er->getTopicID();
        $er_question_id = $er->getQuestionID();

        $sql = 'INSERT INTO er_topics_questions (er_topic_id, er_question_id) VALUES (:er_topic_id, :er_question_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':er_topic_id', $er_topic_id, PDO::PARAM_INT);
        $stmt->bindParam(':er_question_id', $er_question_id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $er_id = (int) $this->pdo->lastInsertId();
        $er->setID($er_id);
        if ($er->getID() === 0) {
            throw new Exception('TopicsQuestions ER not saved', 1);
        }

        return $er;
    }

    private function update(TopicsToQuestions_Relation_Model $er): TopicsToQuestions_Relation_Model
    {
        // We don`t need to update ER
        return $er;
    }

    public function delete(TopicsToQuestions_Relation_Model $er): TopicsToQuestions_Relation_Model
    {
        throw new Exception('TopicsQuestions ER delete not realized', 1);
    }
}
