<?php

class UserFollowCategory_Relation_Validator__validate_exists__negative__IDTest extends PHPUnit\Framework\TestCase
{
    public function test__ID_equal_zero()
    {
        $relation = new \Model\Relation\UserFollowCategory();
        $relation->id = 0;
        $relation->userID = 3;
        $relation->categoryID = 9;

        $this->expectExceptionMessage('UserFollowCategory relation "id" property 0 must be greater than or equal to 1');
        UserFollowCategory_Relation_Validator::validate_exists($relation);
    }

    public function test__ID_below_zero()
    {
        $relation = new \Model\Relation\UserFollowCategory();
        $relation->id = -1;
        $relation->userID = 3;
        $relation->categoryID = 9;

        $this->expectExceptionMessage('UserFollowCategory relation "id" property -1 must be greater than or equal to 1');
        UserFollowCategory_Relation_Validator::validate_exists($relation);
    }
}
