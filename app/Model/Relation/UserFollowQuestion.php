<?php

namespace Model\Relation;

class UserFollowQuestion extends \Model\Model
{
    use \Model\Traits\Relation\UserFollowQuestion;

    public $id;

    public $userID;

    public $questionID;

    public $createdAt;
}
