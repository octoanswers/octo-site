<?php

class UserFollowHashtag_Relation_Model__initWithUserIDAndTopicID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = UserFollowHashtag_Relation_Model::initWithUserIDAndTopicID(3, 9);

        $this->assertEquals(null, $rel->getID());
        $this->assertEquals(3, $rel->getUserID());
        $this->assertEquals(9, $rel->getTopicID());
        $this->assertEquals(null, $rel->getCreatedAt());
    }
}
