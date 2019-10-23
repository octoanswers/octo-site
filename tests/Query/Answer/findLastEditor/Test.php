<?php

namespace Test\Query\User\findLastEditor;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = [
        'ru'    => ['revisions', 'questions'],
        'users' => ['users'],
    ];

    public function test__Base()
    {
        $user = (new \Query\Answer('ru'))->findLastEditor(4);

        $this->assertEquals(4, $user->id);
    }

    public function test__Contributor_not_exists()
    {
        $user = (new \Query\Answer('ru'))->findLastEditor(7);

        $this->assertEquals(null, $user);
    }
}
