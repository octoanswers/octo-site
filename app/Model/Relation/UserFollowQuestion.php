<?php

class UserFollowQuestion_Relation_Model extends Abstract_Model
{
    use UserFollowQuestion_Relation_Model_Trait;

    public $id;
    public $userID;
    public $questionID;
    public $createdAt;
}
