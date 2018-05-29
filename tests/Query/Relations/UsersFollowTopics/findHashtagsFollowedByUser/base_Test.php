<?php

class UsersFollowQuestions_Relations_Query__findTopicsFollowedByUser__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_topics']];

    public function test__RelationExists()
    {
        $followed = (new UsersFollowTopics_Relations_Query('ru'))->findTopicsFollowedByUser(7);

        $this->assertEquals(22, $followed[0]);
        $this->assertEquals(15, $followed[1]);

        $this->assertEquals(2, count($followed));
    }

    public function test__RelationNotExists()
    {
        $followed = (new UsersFollowTopics_Relations_Query('ru'))->findTopicsFollowedByUser(12);

        $this->assertEquals(0, count($followed));
    }
}
