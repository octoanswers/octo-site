<?php

namespace Test\Query\User\user_with_email;

class EmailTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Email_not_exists()
    {
        $user = (new \Query\User())->user_with_email('notexist@email.com');
        $this->assertEquals(null, $user);
    }
}
