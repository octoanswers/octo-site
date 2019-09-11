<?php

class UserFollowCategory_Relation_Model extends Abstract_Model
{
    use UserFollowCategory_Relation_Model_Trait;

    public $id;
    public $userID;
    public $categoryID;
    public $createdAt;
}
