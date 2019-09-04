<?php

class Query_Users_user_with_API_key_negative_APIKey_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testAPIKeyIsEmpty()
    {
        $this->expectExceptionMessage('User "apiKey" property "" must have a length between 25 and 45');
        $user = (new User_Query())->user_with_API_key('');
    }

    public function testAPIKeyIsIncorrect()
    {
        $this->expectExceptionMessage('Incorrect API-key');
        $user = (new User_Query())->user_with_API_key('xxxaaaaacccccbbbbbbeeeeewwwwwwwaaaaa');
    }
}
