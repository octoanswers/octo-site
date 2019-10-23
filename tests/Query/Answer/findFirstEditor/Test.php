<?php

namespace Test\Query\Answer\findFirstEditor;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = [
        'ru'    => ['revisions', 'questions'],
        'users' => ['users'],
    ];

    public function test__Base()
    {
        $user = (new \Query\Answer('ru'))->findFirstEditor(4);

        $this->assertEquals(7, $user->id);
    }

    public function test__Contributor_not_exists()
    {
        $user = (new \Query\Answer('ru'))->findFirstEditor(77);

        $this->assertEquals(null, $user);
    }
}
