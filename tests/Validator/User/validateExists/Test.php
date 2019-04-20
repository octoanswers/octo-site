<?php

class Validator_User_Test extends PHPUnit\Framework\TestCase
{
    public function test_ValidateWithFullParams()
    {
        $user = new User_Model();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->site = 'http://site56.com/steve';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_ValidateWithMinParams()
    {
        $user = new User_Model();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';

        $this->assertEquals(true, User_Validator::validateExists($user));
    }
}
