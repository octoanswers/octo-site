<?php

class Query_Users_userWithID_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_base()
    {
        $user = (new User_Query())->userWithID(4);

        $this->assertEquals(4, $user->getID());
        $this->assertEquals('sasha', $user->getUsername());
        $this->assertEquals('Александр Пушкин', $user->getName());
        $this->assertEquals('pushka@answeropedia.org', $user->email);
        $this->assertEquals('2016-02-26 16:00:46', $user->createdAt);
    }
}
