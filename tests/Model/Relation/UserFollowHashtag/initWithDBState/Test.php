<?php

class UserFollowHashtag_Relation_Model__initWithDBState__Test extends PHPUnit\Framework\TestCase
{
    public function test__EnFullParams_ReturnObject()
    {
        $rel = UserFollowHashtag_Relation_Model::initWithDBState([
            'id' => 13,
            'user_id' => 3,
            'hashtag_id' => 9,
            'created_at' => '2015-11-29 09:28:34'
        ]);

        $this->assertEquals(13, $rel->getID());
        $this->assertEquals(3, $rel->userID);
        $this->assertEquals(9, $rel->hashtagID);
        $this->assertEquals('2015-11-29 09:28:34', $rel->createdAt);
    }

    public function test_RuFullParams_ReturnObject()
    {
        $rel = UserFollowHashtag_Relation_Model::initWithDBState([
            'id' => 13,
            'user_id' => 3,
            'hashtag_id' => 9,
            'created_at' => '2015-11-29 09:28:34'
        ]);

        $this->assertEquals(13, $rel->getID());
        $this->assertEquals(3, $rel->userID);
        $this->assertEquals(9, $rel->hashtagID);
        $this->assertEquals('2015-11-29 09:28:34', $rel->createdAt);
    }
}
