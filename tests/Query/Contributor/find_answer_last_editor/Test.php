<?php

namespace Test\Query\Contributor\find_answer_last_editor;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['revisions', 'questions'], 'users' => ['users']];

    public function test__Base()
    {
        $user = (new \Query\Contributor('ru'))->find_answer_last_editor(4);

        $this->assertEquals(4, $user->id);
    }

    public function test__Contributor_not_exists()
    {
        $user = (new \Query\Contributor('ru'))->find_answer_last_editor(7);

        $this->assertEquals(null, $user);
    }
}
