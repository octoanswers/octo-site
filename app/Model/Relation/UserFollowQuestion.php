<?php

namespace Model\Relation;

class UserFollowQuestion extends \Model\Model
{
    use \Traits\Model\Relation\UserFollowQuestion;

    public $id;
    public $userID;
    public $questionID;
    public $createdAt;
}
