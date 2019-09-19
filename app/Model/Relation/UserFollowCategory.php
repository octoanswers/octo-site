<?php

namespace Model\Relation;

class UserFollowCategory extends \Model\Model
{
    use \UserFollowCategory_Relation_Model_Trait;

    public $id;
    public $userID;
    public $categoryID;
    public $createdAt;
}
