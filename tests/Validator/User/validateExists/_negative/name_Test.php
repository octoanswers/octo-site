<?php

class Validator_User__validate_exists__negative__nameTest extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        $this->user = new \Model\User();
        $this->user->id = 13;
        $this->user->username = 'boris';
        $this->user->name = 'Boris Bro';
        $this->user->signature = 'Foo bar';
        $this->user->email = 'steve@aw.org';
        $this->user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $this->user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $this->user->createdAt = '2016-03-19 06:47:41';
    }

    protected function tearDown(): void
    {
        $this->user = null;
    }

    public function test__Name_not_set()
    {
        $this->user->name = null;

        $this->expectExceptionMessage('User "name" property null must be a string');
        $this->assertEquals(true, User_Validator::validate_exists($this->user));
    }

    public function test__Name_is_empty()
    {
        $this->user->name = '';

        $this->expectExceptionMessage('User "name" property "" must have a length between 2 and 255');
        $this->assertEquals(true, User_Validator::validate_exists($this->user));
    }

    public function test__Name_too_short()
    {
        $this->user->name = 'B';

        $this->expectExceptionMessage('User "name" property "B" must have a length between 2 and 255');
        $this->assertEquals(true, User_Validator::validate_exists($this->user));
    }

    public function test__Name_too_long()
    {
        $this->user->name = 'My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name.';

        $this->expectExceptionMessage('User "name" property "My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name. My Name." must have a length between 2 and 255');
        $this->assertEquals(true, User_Validator::validate_exists($this->user));
    }
}
