<?php

namespace Test\Query\Contributor\findAnswerLastEditor;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['revisions', 'questions'], 'users' => ['users']];

    public function test__Base()
    {
        $user = (new \Query\Contributor('ru'))->findAnswerLastEditor(4);

        $this->assertEquals(4, $user->id);
    }

    public function test__Contributor_not_exists()
    {
        $user = (new \Query\Contributor('ru'))->findAnswerLastEditor(7);

        $this->assertEquals(null, $user);
    }
}
