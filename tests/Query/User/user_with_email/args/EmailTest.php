<?php

namespace Test\Query\User\userWithEmail;

class EmailTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Email_not_exists()
    {
        $user = (new \Query\User())->userWithEmail('notexist@email.com');
        $this->assertEquals(null, $user);
    }
}
