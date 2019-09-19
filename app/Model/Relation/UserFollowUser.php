<?php

namespace Model\Relation;

class UserFollowUser extends \Model\Model
{
    use \UserFollowUser_Relation_Model_Trait;

    public $id;
    public $userID;
    public $followedUserID;
    public $createdAt;
}
