<?php

class UserFollowUser_Relation_Validator__validate_existsTest extends PHPUnit\Framework\TestCase
{
    public function test__Full_params()
    {
        $relation = new \Model\Relation\UserFollowUser();
        $relation->id = 13;
        $relation->userID = 3;
        $relation->followedUserID = 9;
        $relation->createdAt = '2015-11-29 09:28:34';

        $this->assertEquals(true, UserFollowUser_Relation_Validator::validate_exists($relation));
    }

    public function test__Min_params()
    {
        $relation = new \Model\Relation\UserFollowUser();
        $relation->id = 13;
        $relation->userID = 3;
        $relation->followedUserID = 9;

        $this->assertEquals(true, UserFollowUser_Relation_Validator::validate_exists($relation));
    }
}
