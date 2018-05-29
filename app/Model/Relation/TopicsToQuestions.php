<?php

class TopicsToQuestions_Relation_Model
{
    private $id;
    private $topicID;
    private $questionID;
    private $createdAt;

    #
    # Init methods
    #

    public static function initWithTopicIDAndQuestionID(int $topicID, int $questionID): TopicsToQuestions_Relation_Model
    {
        $er = new self();
        $er->topicID = $topicID;
        $er->questionID = $questionID;

        return $er;
    }

    public static function initWithDBState(array $state): TopicsToQuestions_Relation_Model
    {
        $er = new self();

        $er->id = $state['er_id'];
        $er->topicID = $state['er_topic_id'];
        $er->questionID = $state['er_question_id'];
        $er->createdAt = $state['er_created_at'];

        return $er;
    }

    // Getters & setters ------------------------------------------------------

    public function getID()
    {
        return $this->id;
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getTopicID()
    {
        return $this->topicID;
    }

    public function setTopicID(int $topicID)
    {
        $this->topicID = $topicID;
    }

    public function getQuestionID()
    {
        return $this->questionID;
    }

    public function setQuestionID(int $questionID)
    {
        $this->questionID = $questionID;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }
}
