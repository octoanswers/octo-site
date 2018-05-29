<?php

class Validator_User_negative_password_hash_Test extends PHPUnit\Framework\TestCase
{
    public function test_passwordHashNotSet()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->setSignature('Foo bar');
        $user->setEmail('steve@aw.org');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');

        $this->expectExceptionMessage('User "passwordHash" property null must be a string');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_passwordHashIsEmpty()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->setSignature('Foo bar');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('');

        $this->expectExceptionMessage('User "passwordHash" property "" must have a length between 55 and 65');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_passwordHashTooShort()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->setSignature('Foo bar');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('2a0$3f');

        $this->expectExceptionMessage('User "passwordHash" property "2a0$3f" must have a length between 55 and 65');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_passwordHashTooLong()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->setSignature('Foo bar');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy+$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');

        $this->expectExceptionMessage('User "passwordHash" property "$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy+$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy" must have a length between 55 and 65');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }
}
