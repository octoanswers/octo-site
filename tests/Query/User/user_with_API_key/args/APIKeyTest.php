<?php

namespace Test\Query\User\user_with_API_key;

class APIKeyTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function test__API_key_is_empty()
    {
        $this->expectExceptionMessage('User "apiKey" property "" must have a length between 25 and 45');
        $user = (new \Query\User())->user_with_API_key('');
    }

    public function test__API_key_is_incorrect()
    {
        $this->expectExceptionMessage('Incorrect API-key');
        $user = (new \Query\User())->user_with_API_key('xxxaaaaacccccbbbbbbeeeeewwwwwwwaaaaa');
    }
}
