<?php

namespace Model\Relation;

class UserFollowUser extends \Model\Model
{
    use \Model\Traits\Relation\UserFollowUser;

    public $id;

    public $userID;

    public $followedUserID;

    public $createdAt;
}
