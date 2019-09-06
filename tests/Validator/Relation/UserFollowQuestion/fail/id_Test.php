<?php

class UserFollowQuestion_Relation_Validator__id__Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $rel = new UserFollowQuestion_Relation_Model();
        $rel->id = 0;
        $rel->userID = 3;
        $rel->questionID = 9;

        $this->expectExceptionMessage('UserFollowQuestion relation "id" property 0 must be greater than or equal to 1');
        UserFollowQuestion_Relation_Validator::validate_exists($rel);
    }

    public function test__IDBelowZero()
    {
        $rel = new UserFollowQuestion_Relation_Model();
        $rel->id = -1;
        $rel->userID = 3;
        $rel->questionID = 9;

        $this->expectExceptionMessage('UserFollowQuestion relation "id" property -1 must be greater than or equal to 1');
        UserFollowQuestion_Relation_Validator::validate_exists($rel);
    }
}
