<?php

class Query_Users__user_with_ID__abnormal__IDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test__ID_not_exists()
    {
        $this->expectExceptionMessage('User not found');
        (new User_Query())->user_with_ID(667);
    }
}
