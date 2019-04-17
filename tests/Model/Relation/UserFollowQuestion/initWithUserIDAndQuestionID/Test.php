<?php

class UserFollowQuestion_Relation_Model__initWithUserIDAndQuestionID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = UserFollowQuestion_Relation_Model::initWithUserIDAndQuestionID(3, 9);

        $this->assertEquals(null, $rel->getID());
        $this->assertEquals(3, $rel->getUserID());
        $this->assertEquals(9, $rel->questionID);
        $this->assertEquals(null, $rel->createdAt);
    }
}
