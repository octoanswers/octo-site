<?php

class UserFollowQuestion_Relation_Validator__id__Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $rel = new UserFollowQuestion_Relation_Model();
        $rel->setID(0);
        $rel->setUserID(3);
        $rel->setQuestionID(9);

        $this->expectExceptionMessage('UserFollowQuestion relation "id" property 0 must be greater than or equal to 1');
        UserFollowQuestion_Relation_Validator::validateExists($rel);
    }

    public function test__IDBelowZero()
    {
        $rel = new UserFollowQuestion_Relation_Model();
        $rel->setID(-1);
        $rel->setUserID(3);
        $rel->setQuestionID(9);

        $this->expectExceptionMessage('UserFollowQuestion relation "id" property -1 must be greater than or equal to 1');
        UserFollowQuestion_Relation_Validator::validateExists($rel);
    }
}
