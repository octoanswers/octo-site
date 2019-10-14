<?php

namespace Test\Validator\Relation\UserFollowUser\validate_exists;

class IDTest extends \PHPUnit\Framework\TestCase
{
    public function test__ID_equal_zero()
    {
        $relation = new \Model\Relation\UserFollowUser();
        $relation->id = 0;
        $relation->userID = 3;
        $relation->followedUserID = 9;

        $this->expectExceptionMessage('UserFollowUser relation "id" property 0 must be greater than or equal to 1');
        \Validator\Relation\UserFollowUser::validate_exists($relation);
    }

    public function test__ID_below_zero()
    {
        $relation = new \Model\Relation\UserFollowUser();
        $relation->id = -1;
        $relation->userID = 3;
        $relation->followedUserID = 9;

        $this->expectExceptionMessage('UserFollowUser relation "id" property -1 must be greater than or equal to 1');
        \Validator\Relation\UserFollowUser::validate_exists($relation);
    }
}
