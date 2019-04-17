<?php

class UserFollowHashtag_Relation_Model__initWithUserIDAndHashtagID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = UserFollowHashtag_Relation_Model::initWithUserIDAndHashtagID(3, 9);

        $this->assertEquals(null, $rel->getID());
        $this->assertEquals(3, $rel->userID);
        $this->assertEquals(9, $rel->getHashtagID());
        $this->assertEquals(null, $rel->createdAt);
    }
}
