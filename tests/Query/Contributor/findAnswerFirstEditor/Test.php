<?php

class Contributor_Query__find_answer_first_editor__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions'], 'users' => ['users']];

    public function test__Base()
    {
        $user = (new Contributor_Query('ru'))->find_answer_first_editor(4);

        $this->assertEquals(7, $user->id);
    }

    public function test_ContributorNotExists()
    {
        $user = (new Contributor_Query('ru'))->find_answer_first_editor(77);

        $this->assertEquals(null, $user);
    }
}
