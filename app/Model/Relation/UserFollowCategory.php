<?php

namespace Model\Relation;

class UserFollowCategory extends \Model\Model
{
    use \Traits\Model\Relation\UserFollowCategory;

    public $id;
    public $userID;
    public $categoryID;
    public $createdAt;
}
