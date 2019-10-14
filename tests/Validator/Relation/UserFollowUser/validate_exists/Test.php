<?php

namespace Test\Validator\Relation\UserFollowUser\validateExists;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Full_params()
    {
        $relation = new \Model\Relation\UserFollowUser();
        $relation->id = 13;
        $relation->userID = 3;
        $relation->followedUserID = 9;
        $relation->createdAt = '2015-11-29 09:28:34';

        $this->assertEquals(true, \Validator\Relation\UserFollowUser::validateExists($relation));
    }

    public function test__Min_params()
    {
        $relation = new \Model\Relation\UserFollowUser();
        $relation->id = 13;
        $relation->userID = 3;
        $relation->followedUserID = 9;

        $this->assertEquals(true, \Validator\Relation\UserFollowUser::validateExists($relation));
    }
}
