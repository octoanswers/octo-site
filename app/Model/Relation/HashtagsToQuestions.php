<?php

class HashtagsToQuestions_Relation_Model extends Abstract_Model
{
    public $id;
    public $hashtagID;
    public $questionID;
    public $createdAt;

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
}
