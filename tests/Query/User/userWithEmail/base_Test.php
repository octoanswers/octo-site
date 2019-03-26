<?php

class Users_Query__userWithEmail__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_base()
    {
        $user = (new User_Query())->userWithEmail('pushka@answeropedia.org');

        $this->assertEquals(4, $user->getID());
        $this->assertEquals('sasha', $user->getUsername());
        $this->assertEquals('Александр Пушкин', $user->getName());
        $this->assertEquals('pushka@answeropedia.org', $user->getEmail());
        $this->assertEquals('2016-02-26 16:00:46', $user->getCreatedAt());
    }
}
