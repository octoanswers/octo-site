<?php

class Validator_User__negative_name_Test extends PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        $this->user = new User_Model();
        $this->user->setID(13);
        $this->user->setUsername('boris');
        $this->user->setName('Boris Bro');
        $this->user->setSignature('Foo bar');
        $this->user->setEmail('steve@aw.org');
        $this->user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $this->user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');
        $this->user->setCreatedAt('2016-03-19 06:47:41');
    }

    protected function tearDown()
    {
        $this->user = null;
    }

    public function test_nameNotSet()
    {
        $this->user->setName(null);

        $this->expectExceptionMessage('User "name" property null must be a string');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_nameIsEmpty()
    {
        $this->user->setName('');

        $this->expectExceptionMessage('User "name" property "" must have a length between 2 and 255');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_NameTooShort()
    {
        $this->user->setName('B');

        $this->expectExceptionMessage('User "name" property "B" must have a length between 2 and 255');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_NameTooLong()
    {
        $this->user->setName('My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name.');

        $this->expectExceptionMessage('User "name" property "My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name." must have a length between 2 and 255');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }
}
