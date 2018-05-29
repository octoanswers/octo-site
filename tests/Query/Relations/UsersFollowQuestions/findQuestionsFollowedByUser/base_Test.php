<?php

class UsersFollowQuestions_Relations_Query__findQuestionsFollowedByUser__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_questions']];

    public function test__RelationsExists()
    {
        $followed = (new UsersFollowQuestions_Relations_Query('ru'))->findQuestionsFollowedByUser(7);

        $this->assertEquals(22, $followed[0]);
        $this->assertEquals(23, $followed[1]);

        $this->assertEquals(2, count($followed));
    }

    public function test__RelationNotExists()
    {
        $followed = (new UsersFollowQuestions_Relations_Query('ru'))->findQuestionsFollowedByUser(12);

        $this->assertEquals(0, count($followed));
    }
}
