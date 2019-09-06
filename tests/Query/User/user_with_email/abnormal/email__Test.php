<?php

class Query_Users__user_with_email__abnormal__emailTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test__Email_not_exists()
    {
        $user = (new User_Query())->user_with_email('notexist@email.com');
        $this->assertEquals(null, $user);
    }
}
