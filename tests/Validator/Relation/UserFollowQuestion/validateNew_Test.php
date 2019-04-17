<?php

class UserFollowQuestion_Relation_Validator__validateNew__Test extends PHPUnit\Framework\TestCase
{
    public function test__FullParams__OK()
    {
        $rel = new UserFollowQuestion_Relation_Model();
        $rel->userID = 3;
        $rel->questionID = 9;
        $rel->createdAt = '2015-11-29 09:28:34';

        $this->assertEquals(true, UserFollowQuestion_Relation_Validator::validateNew($rel));
    }

    public function test__MinParams__OK()
    {
        $rel = new UserFollowQuestion_Relation_Model();
        $rel->userID = 3;
        $rel->questionID = 9;

        $this->assertEquals(true, UserFollowQuestion_Relation_Validator::validateNew($rel));
    }
}
