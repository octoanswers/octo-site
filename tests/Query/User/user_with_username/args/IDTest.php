<?php

namespace Test\Query\User\userWithUsername;

class IDTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function test__ID_not_exists()
    {
        $user = (new \Query\User())->userWithUsername('notexist667');
        $this->assertEquals(null, $user);
    }
}
