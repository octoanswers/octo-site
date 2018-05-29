<?php

class UserFollowUser_Relation_Validator__validateNew__Test extends PHPUnit\Framework\TestCase
{
    public function test__FullParams__OK()
    {
        $relation = new UserFollowUser_Relation_Model();
        $relation->setUserID(3);
        $relation->setFollowedUserID(9);
        $relation->setCreatedAt('2015-11-29 09:28:34');

        $this->assertEquals(true, UserFollowUser_Relation_Validator::validateNew($relation));
    }

    public function test__MinParams__OK()
    {
        $relation = new UserFollowUser_Relation_Model();
        $relation->setUserID(3);
        $relation->setFollowedUserID(9);

        $this->assertEquals(true, UserFollowUser_Relation_Validator::validateNew($relation));
    }
}
