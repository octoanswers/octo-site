<?php

class Query_Users__user_with_email__abnormal__emailTest extends \Tests\DB\TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Email_not_exists()
    {
        $user = (new \Query\User())->user_with_email('notexist@email.com');
        $this->assertEquals(null, $user);
    }
}
