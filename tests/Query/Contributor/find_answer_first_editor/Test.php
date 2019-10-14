<?php

namespace Test\Query\Contributor\findAnswerFirstEditor;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['revisions', 'questions'], 'users' => ['users']];

    public function test__Base()
    {
        $user = (new \Query\Contributor('ru'))->findAnswerFirstEditor(4);

        $this->assertEquals(7, $user->id);
    }

    public function test__Contributor_not_exists()
    {
        $user = (new \Query\Contributor('ru'))->findAnswerFirstEditor(77);

        $this->assertEquals(null, $user);
    }
}
