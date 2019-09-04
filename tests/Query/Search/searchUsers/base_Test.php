<?php

class Query_Search_search_users_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_SearchWithTwoResults_Ok()
    {
        $users = (new Search_Query('users'))->search_users('сява');

        $this->assertEquals(1, count($users));

        $this->assertEquals(2, $users[0]->id);
        $this->assertEquals('Сява Черемшов', $users[0]->name);
    }
}
