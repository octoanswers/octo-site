<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class HashtagsToQuestions_Relations_Query extends Abstract_Query
{
    const QUESTIONS_PER_PAGE = 10; // @TODO double

    public function findNewestForTopicWithID(int $topic_id, int $page = 1, int $per_page = 10): array
    {
        TopicToQuestion_Relation_Validator::validateTopicID($topic_id);
        QuestionsList_Validator::validatePage($page);
        QuestionsList_Validator::validatePerPage($per_page);

        $offset = $per_page * ($page - 1);

        $stmt = $this->pdo->prepare('SELECT * FROM `er_topics_questions` WHERE er_topic_id = :er_topic_id ORDER BY er_id DESC LIMIT :id_offset, :per_page');
        $stmt->bindParam(':er_topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':per_page', $per_page, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ERs = [];
        foreach ($rows as $row) {
            $ERs[] = TopicsToQuestions_Relation_Model::initWithDBState($row);
        }

        return $ERs;
    }

    public function findByTopicIDAndQuestionID(int $topic_id, int $question_id)
    {
        TopicToQuestion_Relation_Validator::validateTopicID($topic_id);
        TopicToQuestion_Relation_Validator::validateQuestionID($question_id);

        $stmt = $this->pdo->prepare('SELECT * FROM er_topics_questions WHERE er_topic_id=:er_topic_id AND er_question_id=:er_question_id LIMIT 1');
        $stmt->bindParam(':er_topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->bindParam(':er_question_id', $question_id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $error = $stmt->errorInfo();
            throw new Exception($error[2], $error[1]);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        return TopicsToQuestions_Relation_Model::initWithDBState($row);
    }

    public function findByTopicTitleAndQuestionID(string $topic_title, int $question_id)
    {
        Topic_Validator::validateTitle($topic_title);
        TopicToQuestion_Relation_Validator::validateQuestionID($question_id);

        $topic = (new Topic_Query($this->lang))->findWithTitle($topic_title);
        if ($topic === null) {
            return null;
        }

        return (new TopicsToQuestions_Relations_Query($this->lang))->findByTopicIDAndQuestionID($topic->getID(), $question_id);
    }
}
