<?php

class UserFollowQuestion_Relation_Model extends Abstract_Model
{
    private $id;
    public $userID;
    public $questionID;
    public $createdAt;

    #
    # Init methods
    #

    public static function initWithUserIDAndQuestionID(int $userID, int $questionID): UserFollowQuestion_Relation_Model
    {
        $er = new self();
        $er->userID = $userID;
        $er->questionID = $questionID;

        return $er;
    }

    public static function initWithDBState(array $state): UserFollowQuestion_Relation_Model
    {
        $er = new self();

        $er->id = (int) $state['id'];
        $er->userID = (int) $state['user_id'];
        $er->questionID = (int) $state['question_id'];
        $er->createdAt = $state['created_at'];

        return $er;
    }

    #
    # Getters & setters
    #

    public function getID()
    {
        return $this->id;
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }
}
