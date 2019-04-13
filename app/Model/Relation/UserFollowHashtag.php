<?php

class UserFollowHashtag_Relation_Model
{
    private $id;
    private $userID;
    private $hashtagID;
    private $createdAt;

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

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID(int $userID)
    {
        $this->userID = $userID;
    }

    public function getHashtagID()
    {
        return $this->hashtagID;
    }

    public function setHashtagID(int $hashtagID)
    {
        $this->hashtagID = $hashtagID;
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
