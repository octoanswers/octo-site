<?php

class Validator_User__validate_exists__negative__password_hashTest extends PHPUnit\Framework\TestCase
{
    public function test__Password_hash_not_set()
    {
        $user = new \Model\User();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';

        $this->expectExceptionMessage('User "passwordHash" property null must be a string');
        $this->assertEquals(true, \Validator\User::validate_exists($user));
    }

    public function test__Password_hash_is_empty()
    {
        $user = new \Model\User();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '';

        $this->expectExceptionMessage('User "passwordHash" property "" must have a length between 55 and 65');
        $this->assertEquals(true, \Validator\User::validate_exists($user));
    }

    public function test__Password_hash_too_short()
    {
        $user = new \Model\User();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '2a0$3f';

        $this->expectExceptionMessage('User "passwordHash" property "2a0$3f" must have a length between 55 and 65');
        $this->assertEquals(true, \Validator\User::validate_exists($user));
    }

    public function test__Password_hash_too_long()
    {
        $user = new \Model\User();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy+$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';

        $this->expectExceptionMessage('User "passwordHash" property "$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy+$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy" must have a length between 55 and 65');
        $this->assertEquals(true, \Validator\User::validate_exists($user));
    }
}
