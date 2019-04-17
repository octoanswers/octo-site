<?php

class UsersFollowHashtags_Relations_Query__relationWithUserIDAndHashtagID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_hashtags']];

    public function test__RelationExists()
    {
        $relation = (new UsersFollowHashtags_Relations_Query('ru'))->relationWithUserIDAndHashtagID(2, 16);

        $this->assertEquals(6, $relation->getID());
        $this->assertEquals(2, $relation->getUserID());
        $this->assertEquals(16, $relation->getHashtagID());
        $this->assertEquals('2014-12-16 11:28:56', $relation->createdAt);
    }

    public function test__RelationNotExists()
    {
        $relation = (new UsersFollowHashtags_Relations_Query('ru'))->relationWithUserIDAndHashtagID(3, 99);

        $this->assertEquals(null, $relation);
    }
}
