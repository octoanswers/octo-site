<?php

class Query_Users_userWithID__abnormal__id__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testIDNotExists()
    {
        $this->expectExceptionMessage('User not found');
        (new User_Query())->userWithID(667);
    }
}
