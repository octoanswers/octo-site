<?php

class Validator_User_negative_api_key_Test extends PHPUnit\Framework\TestCase
{
    public function test_APIKeyNotSet()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->setSignature('Foo bar');
        $user->email = 'steve@aw.org';
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');

        $this->expectExceptionMessage('User "apiKey" property null must be a string');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_APIKeyIsEmpty()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->setSignature('Foo bar');
        $user->email = 'steve@aw.org';
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('');

        $this->expectExceptionMessage('User "apiKey" property "" must have a length between 25 and 45');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_APIKeyTooShort()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->setSignature('Foo bar');
        $user->email = 'steve@aw.org';
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('4447');

        $this->expectExceptionMessage('User "apiKey" property "4447" must have a length between 25 and 45');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_APIKeyTooLong()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->setUsername('boris');
        $user->setName('Boris Bro');
        $user->setSignature('Foo bar');
        $user->email = 'steve@aw.org';
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271+4447243e3e1766375d23b06bf6dd1271');

        $this->expectExceptionMessage('User "apiKey" property "4447243e3e1766375d23b06bf6dd1271+4447243e3e1766375d23b06bf6dd1271" must have a length between 25 and 45');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }
}
