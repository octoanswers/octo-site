<?php

class UsersFollowQuestions_Relations_Query__findHashtagsFollowedByUser__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_hashtags']];

    public function test__RelationExists()
    {
        $followed = (new UsersFollowHashtags_Relations_Query('ru'))->findHashtagsFollowedByUser(7);

        $this->assertEquals(22, $followed[0]);
        $this->assertEquals(15, $followed[1]);

        $this->assertEquals(2, count($followed));
    }

    public function test__RelationNotExists()
    {
        $followed = (new UsersFollowHashtags_Relations_Query('ru'))->findHashtagsFollowedByUser(12);

        $this->assertEquals(0, count($followed));
    }
}
