<?php

class Validator_User_negative_timestamp_Test extends PHPUnit\Framework\TestCase
{
    public function test_timestampNotSet()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';

        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_timestampIsEmpty()
    {
        $user = new User_Model();
        $user->setID(13);
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '';

        $this->assertEquals(true, User_Validator::validateExists($user));
        $this->assertEquals(null, $user->createdAt);
    }
}
