<?php

class Contributor_Query__findAnswerFirstEditor__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions'], 'users' => ['users']];

    public function test__Base()
    {
        $user = (new Contributor_Query('ru'))->findAnswerFirstEditor(4);

        $this->assertEquals(7, $user->getID());
    }

    public function test_ContributorNotExists()
    {
        $user = (new Contributor_Query('ru'))->findAnswerFirstEditor(77);

        $this->assertEquals(null, $user);
    }
}
