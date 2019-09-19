<?php

namespace Model\Relation;

class UserFollowQuestion extends \Model\Model
{
    use \UserFollowQuestion_Relation_Model_Trait;

    public $id;
    public $userID;
    public $questionID;
    public $createdAt;
}
