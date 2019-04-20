<?php

class User_Validator__negative__username__Test extends PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        $this->user = new User_Model();
        $this->user->id = 13;
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

    public function test_UsernameNotSet()
    {
        $this->user->username = null;

        $this->expectExceptionMessage('User "username" property null must be a string');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_UsernameContainWhitespace()
    {
        $this->user->username = 'foo bar';

        $this->expectExceptionMessage('User "username" property "foo bar" must not contain whitespace');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_UsernameIncludeNotAllowedSymbols()
    {
        $this->user->username = 'саша';

        $this->expectExceptionMessage('User "username" property "саша" must contain only letters (a-z) and digits (0-9)');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_UsernameIsEmpty()
    {
        $this->user->username = '';

        $this->expectExceptionMessage('User "username" property "" must have a length between 3 and 64');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_UsernameTooShort()
    {
        $this->user->username = 'B';

        $this->expectExceptionMessage('User "username" property "B" must have a length between 3 and 64');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }

    public function test_UsernameTooLong()
    {
        $this->user->username = 'mynamemynamemynamemynamemynamemynamemynamemynamemynamemynamemyname';

        $this->expectExceptionMessage('User "username" property "mynamemynamemynamemynamemynamemynamemynamemynamemynamemynamemyname" must have a length between 3 and 64');
        $this->assertEquals(true, User_Validator::validateExists($this->user));
    }
}
