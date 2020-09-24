<?php

namespace Test\Query\Search\searchUsers;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Search_with_two_results()
    {
        $users = (new \Query\Search('users'))->searchUsers('сява');

        $this->assertEquals(1, count($users));

        $this->assertEquals(2, $users[0]->id);
        $this->assertEquals('Сява Черемшов', $users[0]->name);
    }
}
