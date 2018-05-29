<?php

class UsersFollowTopics_Relations_Query__relationWithUserIDAndTopicID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_topics']];

    public function test__RelationExists()
    {
        $relation = (new UsersFollowTopics_Relations_Query('ru'))->relationWithUserIDAndTopicID(2, 16);

        $this->assertEquals(6, $relation->getID());
        $this->assertEquals(2, $relation->getUserID());
        $this->assertEquals(16, $relation->getTopicID());
        $this->assertEquals('2014-12-16 11:28:56', $relation->getCreatedAt());
    }

    public function test__RelationNotExists()
    {
        $relation = (new UsersFollowTopics_Relations_Query('ru'))->relationWithUserIDAndTopicID(3, 99);

        $this->assertEquals(null, $relation);
    }
}
