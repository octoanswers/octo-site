<?php

class UserFollowUser_Relation_Model extends Abstract_Model
{
    use UserFollowUser_Relation_Model_Trait;

    public $id;
    public $userID;
    public $followedUserID;
    public $createdAt;
}
