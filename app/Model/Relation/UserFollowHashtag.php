<?php

class UserFollowHashtag_Relation_Model extends Abstract_Model
{
    private $id;
    public $userID;
    public $hashtagID;
    public $createdAt;

    #
    # Init methods
    #

    public static function initWithUserIDAndHashtagID(int $userID, int $hashtagID): UserFollowHashtag_Relation_Model
    {
        $er = new self();
        $er->userID = $userID;
        $er->hashtagID = $hashtagID;

        return $er;
    }

    public static function initWithDBState(array $state): UserFollowHashtag_Relation_Model
    {
        $er = new self();

        $er->id = (int) $state['id'];
        $er->userID = (int) $state['user_id'];
        $er->hashtagID = (int) $state['hashtag_id'];
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
