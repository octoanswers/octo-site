<?php

class UserFollowUser_Relation_Model extends Abstract_Model
{
    private $id;
    private $userID;
    private $followedUserID;
    public $createdAt;

    #
    # Init methods
    #

    public static function initWithUserIDAndFollowedUserID(int $userID, int $followedUserID): UserFollowUser_Relation_Model
    {
        $er = new self();
        $er->userID = $userID;
        $er->followedUserID = $followedUserID;

        return $er;
    }

    public static function initWithDBState(array $state): UserFollowUser_Relation_Model
    {
        $er = new self();

        $er->id = (int) $state['id'];
        $er->userID = (int) $state['user_id'];
        $er->followedUserID = (int) $state['followed_user_id'];
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

    public function getFollowedUserID()
    {
        return $this->followedUserID;
    }

    public function setFollowedUserID(int $followedUserID)
    {
        $this->followedUserID = $followedUserID;
    }
}
