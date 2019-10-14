<?php

namespace Test\Query\User\user_with_ID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Base()
    {
        $user = (new \Query\User())->userWithID(4);

        $this->assertEquals(4, $user->id);
        $this->assertEquals('sasha', $user->username);
        $this->assertEquals('Александр Пушкин', $user->name);
        $this->assertEquals('pushka@answeropedia.org', $user->email);
        $this->assertEquals('2016-02-26 16:00:46', $user->createdAt);
    }
}
