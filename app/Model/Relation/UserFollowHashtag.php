<?php

class UserFollowHashtag_Relation_Model
{
    private $id;
    private $userID;
    private $topicID;
    private $createdAt;

    #
    # Init methods
    #

    public static function initWithUserIDAndTopicID(int $userID, int $topicID): UserFollowHashtag_Relation_Model
    {
        $er = new self();
        $er->userID = $userID;
        $er->topicID = $topicID;

        return $er;
    }

    public static function initWithDBState(array $state): UserFollowHashtag_Relation_Model
    {
        $er = new self();

        $er->id = (int) $state['id'];
        $er->userID = (int) $state['user_id'];
        $er->topicID = (int) $state['topic_id'];
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

    public function getTopicID()
    {
        return $this->topicID;
    }

    public function setTopicID(int $topicID)
    {
        $this->topicID = $topicID;
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
