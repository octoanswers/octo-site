<?php

namespace Model\Relation;

class UserFollowCategory extends \Model\Model
{
    use \Model\Traits\Relation\UserFollowCategory;

    public $id;

    public $userID;

    public $categoryID;

    public $createdAt;
}
