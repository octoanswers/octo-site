<?php

class Query_Users__user_with_IDTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Base()
    {
        $user = (new \Query\User())->user_with_ID(4);

        $this->assertEquals(4, $user->id);
        $this->assertEquals('sasha', $user->username);
        $this->assertEquals('Александр Пушкин', $user->name);
        $this->assertEquals('pushka@answeropedia.org', $user->email);
        $this->assertEquals('2016-02-26 16:00:46', $user->createdAt);
    }
}
