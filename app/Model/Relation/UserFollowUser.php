<?php

namespace Model\Relation;

class UserFollowUser extends \Model\Model
{
    use \Traits\Model\Relation\UserFollowUser;

    public $id;
    public $userID;
    public $followedUserID;
    public $createdAt;
}
