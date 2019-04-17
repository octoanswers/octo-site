<?php

class Users_Query__userWithUsername__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_base()
    {
        $user = (new User_Query())->userWithUsername('sasha');

        $this->assertEquals(4, $user->getID());
        $this->assertEquals('sasha', $user->getUsername());
        $this->assertEquals('Александр Пушкин', $user->getName());
        $this->assertEquals('pushka@answeropedia.org', $user->email);
        $this->assertEquals('2016-02-26 16:00:46', $user->createdAt);
    }
}
