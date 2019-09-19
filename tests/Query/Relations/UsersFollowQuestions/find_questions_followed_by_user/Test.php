<?php

class Query_Relations_UsersFollowQuestions__find_questions_followed_by_userTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_questions']];

    public function test__Relations_exists()
    {
        $followed = (new \Query\Relations\UsersFollowQuestions('ru'))->find_questions_followed_by_user(7);

        $this->assertEquals(22, $followed[0]);
        $this->assertEquals(23, $followed[1]);

        $this->assertEquals(2, count($followed));
    }

    public function test__Relation_not_exists()
    {
        $followed = (new \Query\Relations\UsersFollowQuestions('ru'))->find_questions_followed_by_user(12);

        $this->assertEquals(0, count($followed));
    }
}
