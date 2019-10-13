<?php

class Query_Contributor__find_answer_first_editorTest extends \Tests\DB\TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions'], 'users' => ['users']];

    public function test__Base()
    {
        $user = (new \Query\Contributor('ru'))->find_answer_first_editor(4);

        $this->assertEquals(7, $user->id);
    }

    public function test__Contributor_not_exists()
    {
        $user = (new \Query\Contributor('ru'))->find_answer_first_editor(77);

        $this->assertEquals(null, $user);
    }
}
