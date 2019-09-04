<?php

class Query_Users_user_with_ID_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_base()
    {
        $user = (new User_Query())->user_with_ID(4);

        $this->assertEquals(4, $user->id);
        $this->assertEquals('sasha', $user->username);
        $this->assertEquals('Александр Пушкин', $user->name);
        $this->assertEquals('pushka@answeropedia.org', $user->email);
        $this->assertEquals('2016-02-26 16:00:46', $user->createdAt);
    }
}
