<?php

class Contributor_Query__find_answer_last_editorTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions'], 'users' => ['users']];

    public function test__Base()
    {
        $user = (new Contributor_Query('ru'))->find_answer_last_editor(4);

        $this->assertEquals(4, $user->id);
    }

    public function test__Contributor_not_exists()
    {
        $user = (new Contributor_Query('ru'))->find_answer_last_editor(7);

        $this->assertEquals(null, $user);
    }
}
