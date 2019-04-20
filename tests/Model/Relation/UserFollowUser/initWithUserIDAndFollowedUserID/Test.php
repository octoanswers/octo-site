<?php

class UserFollowUser_Relation_Model__initWithUserIDAndFollowedUserID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = UserFollowUser_Relation_Model::initWithUserIDAndFollowedUserID(3, 9);

        $this->assertEquals(null, $rel->id);
        $this->assertEquals(3, $rel->userID);
        $this->assertEquals(9, $rel->followedUserID);
        $this->assertEquals(null, $rel->createdAt);
    }
}
