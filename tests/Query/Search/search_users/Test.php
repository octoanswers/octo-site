<?php

class Query_Search__search_usersTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Search_with_two_results()
    {
        $users = (new \Query\Search('users'))->search_users('сява');

        $this->assertEquals(1, count($users));

        $this->assertEquals(2, $users[0]->id);
        $this->assertEquals('Сява Черемшов', $users[0]->name);
    }
}
