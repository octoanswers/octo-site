<?php

namespace Test\Query\Relations\UsersFollowQuestions\findQuestionsFollowedByUser;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_users_follow_questions']];

    public function test__Relations_exists()
    {
        $followed = (new \Query\Relations\UsersFollowQuestions('ru'))->findQuestionsFollowedByUser(7);

        $this->assertEquals(22, $followed[0]);
        $this->assertEquals(23, $followed[1]);

        $this->assertEquals(2, count($followed));
    }

    public function test__Relation_not_exists()
    {
        $followed = (new \Query\Relations\UsersFollowQuestions('ru'))->findQuestionsFollowedByUser(12);

        $this->assertEquals(0, count($followed));
    }
}
