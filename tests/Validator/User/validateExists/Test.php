<?php

class Validator_User_Test extends PHPUnit\Framework\TestCase
{
    public function test_ValidateWithFullParams()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->setSignature('Foo bar');
        $user->setSite('http://site56.com/steve');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');
        $user->setCreatedAt('2016-03-19 06:47:41');

        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_ValidateWithMinParams()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');

        $this->assertEquals(true, User_Validator::validateExists($user));
    }
}
