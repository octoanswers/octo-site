<?php

class Validator_User_negative_email_Test extends PHPUnit\Framework\TestCase
{
    public function test_NotSet()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');

        $this->expectExceptionMessage('User "email" property null must be a string');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_IncorrectEmail()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->email = 'steve_answeropedia.org';

        $this->expectExceptionMessage('User "email" property "steve_answeropedia.org" must be valid email');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }
}
