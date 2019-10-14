<?php

namespace Test\Validator\User\validate_exists;

class EmailTest extends \PHPUnit\Framework\TestCase
{
    public function test__Email_not_set()
    {
        $user = new \Model\User();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';

        $this->expectExceptionMessage('User "email" property null must be a string');
        $this->assertEquals(true, \Validator\User::validate_exists($user));
    }

    public function test__Incorrect_email()
    {
        $user = new \Model\User();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->email = 'steve_answeropedia.org';

        $this->expectExceptionMessage('User "email" property "steve_answeropedia.org" must be valid email');
        $this->assertEquals(true, \Validator\User::validate_exists($user));
    }
}
