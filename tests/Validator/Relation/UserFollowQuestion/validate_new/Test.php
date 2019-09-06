<?php

class UserFollowQuestion_Relation_Validator__validate_newTest extends PHPUnit\Framework\TestCase
{
    public function test__Full_params()
    {
        $rel = new UserFollowQuestion_Relation_Model();
        $rel->userID = 3;
        $rel->questionID = 9;
        $rel->createdAt = '2015-11-29 09:28:34';

        $this->assertEquals(true, UserFollowQuestion_Relation_Validator::validate_new($rel));
    }

    public function test__Min_params()
    {
        $rel = new UserFollowQuestion_Relation_Model();
        $rel->userID = 3;
        $rel->questionID = 9;

        $this->assertEquals(true, UserFollowQuestion_Relation_Validator::validate_new($rel));
    }
}
