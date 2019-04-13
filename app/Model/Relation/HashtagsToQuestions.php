<?php

class HashtagsToQuestions_Relation_Model
{
    private $id;
    private $hashtagID;
    private $questionID;
    private $createdAt;

    #
    # Init methods
    #

    public static function initWithHashtagIDAndQuestionID(int $hashtagID, int $questionID): HashtagsToQuestions_Relation_Model
    {
        $er = new self();
        $er->hashtagID = $hashtagID;
        $er->questionID = $questionID;

        return $er;
    }

    public static function initWithDBState(array $state): HashtagsToQuestions_Relation_Model
    {
        $er = new self();

        $er->id = $state['er_id'];
        $er->hashtagID = $state['er_hashtag_id'];
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

    public function getHashtagID()
    {
        return $this->hashtagID;
    }

    public function setHashtagID(int $hashtagID)
    {
        $this->hashtagID = $hashtagID;
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
