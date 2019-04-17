<?php

class Validator_User__negative_name_Test extends PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        $this->user = new User_Model();
        $this->user->setID(13);
        $this->user->username = 'boris';
        $this->user->name = 'Boris Bro';
        $this->user->signature = 'Foo bar';
        $this->user->email = 'steve@aw.org';
        $this->user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $this->user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $this->user->createdAt = '2016-03-19 06:47:41';
    }

    protected function tearDown()
    {
        $this->user = null;
    }

    public function test_nameNotSet()
    {
        $this->user->name = null;

        $this->expectExceptionMessage('User "name" property null must be a string');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_nameIsEmpty()
    {
        $this->user->name = '';

        $this->expectExceptionMessage('User "name" property "" must have a length between 2 and 255');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_NameTooShort()
    {
        $this->user->name = 'B';

        $this->expectExceptionMessage('User "name" property "B" must have a length between 2 and 255');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_NameTooLong()
    {
        $this->user->name = 'My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name.';

        $this->expectExceptionMessage('User "name" property "My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name." must have a length between 2 and 255');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }
}
