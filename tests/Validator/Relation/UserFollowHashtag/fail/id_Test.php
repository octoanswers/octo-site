<?php

class UserFollowHashtag_Relation_Validator__id__Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $relation = new UserFollowHashtag_Relation_Model();
        $relation->setID(0);
        $relation->userID = 3;
        $relation->setHashtagID(9);

        $this->expectExceptionMessage('UserFollowHashtag relation "id" property 0 must be greater than or equal to 1');
        UserFollowHashtag_Relation_Validator::validateExists($relation);
    }

    public function test__IDBelowZero()
    {
        $relation = new UserFollowHashtag_Relation_Model();
        $relation->setID(-1);
        $relation->userID = 3;
        $relation->setHashtagID(9);

        $this->expectExceptionMessage('UserFollowHashtag relation "id" property -1 must be greater than or equal to 1');
        UserFollowHashtag_Relation_Validator::validateExists($relation);
    }
}
