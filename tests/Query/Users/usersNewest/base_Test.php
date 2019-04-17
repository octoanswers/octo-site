<?php

class Query_Users_usersNewest_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_noParams()
    {
        $users = (new Users_Query())->usersNewest();

        $this->assertEquals(10, count($users));

        $firstUser = $users[0];
        $this->assertEquals(15, $firstUser->getID());
        $this->assertEquals('leo', $firstUser->username);
        $this->assertEquals('Лев Толстой', $firstUser->name);

        $lastUser = $users[9];
        $this->assertEquals(6, $lastUser->getID());
        $this->assertEquals('kozel', $lastUser->username);
        $this->assertEquals('Виталий Козлов', $lastUser->name);
    }
}
