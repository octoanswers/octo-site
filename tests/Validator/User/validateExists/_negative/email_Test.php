<?php

class Validator_User__validate_exists__negative__emailTest extends PHPUnit\Framework\TestCase
{
    public function test__Email_not_set()
    {
        $user = new User_Model();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';

        $this->expectExceptionMessage('User "email" property null must be a string');
        $this->assertEquals(true, User_Validator::validate_exists($user));
    }

    public function test__Incorrect_email()
    {
        $user = new User_Model();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->email = 'steve_answeropedia.org';

        $this->expectExceptionMessage('User "email" property "steve_answeropedia.org" must be valid email');
        $this->assertEquals(true, User_Validator::validate_exists($user));
    }
}
