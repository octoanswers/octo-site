<?php

class UserFollowUser_Relation_Model__init_with_user_ID_and_followed_user_ID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = UserFollowUser_Relation_Model::init_with_user_ID_and_followed_user_ID(3, 9);

        $this->assertEquals(null, $rel->id);
        $this->assertEquals(3, $rel->userID);
        $this->assertEquals(9, $rel->followedUserID);
        $this->assertEquals(null, $rel->createdAt);
    }
}
