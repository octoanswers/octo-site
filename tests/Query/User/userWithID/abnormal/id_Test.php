<?php

class Query_Users_user_with_ID__abnormal__id__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testIDNotExists()
    {
        $this->expectExceptionMessage('User not found');
        (new User_Query())->user_with_ID(667);
    }
}
