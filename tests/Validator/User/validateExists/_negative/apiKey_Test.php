<?php

class Validator_User__validate_exists__negative__api_key_Test extends PHPUnit\Framework\TestCase
{
    public function test__API_key_not_set()
    {
        $user = new User_Model();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';

        $this->expectExceptionMessage('User "apiKey" property null must be a string');
        $this->assertEquals(true, User_Validator::validate_exists($user));
    }

    public function test__API_key_is_empty()
    {
        $user = new User_Model();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '';

        $this->expectExceptionMessage('User "apiKey" property "" must have a length between 25 and 45');
        $this->assertEquals(true, User_Validator::validate_exists($user));
    }

    public function test__API_key_too_short()
    {
        $user = new User_Model();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447';

        $this->expectExceptionMessage('User "apiKey" property "4447" must have a length between 25 and 45');
        $this->assertEquals(true, User_Validator::validate_exists($user));
    }

    public function test__API_key_too_long()
    {
        $user = new User_Model();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271+4447243e3e1766375d23b06bf6dd1271';

        $this->expectExceptionMessage('User "apiKey" property "4447243e3e1766375d23b06bf6dd1271+4447243e3e1766375d23b06bf6dd1271" must have a length between 25 and 45');
        $this->assertEquals(true, User_Validator::validate_exists($user));
    }
}
