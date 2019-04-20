<?php

class Contributor_Query__findAnswerLastEditor__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions'], 'users' => ['users']];

    public function test__Base()
    {
        $user = (new Contributor_Query('ru'))->findAnswerLastEditor(4);

        $this->assertEquals(4, $user->id);
    }

    public function test_ContributorNotExists()
    {
        $user = (new Contributor_Query('ru'))->findAnswerLastEditor(7);

        $this->assertEquals(null, $user);
    }
}
