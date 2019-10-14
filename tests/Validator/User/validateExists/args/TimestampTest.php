<?php

namespace Test\Validator\User\validateExists;

class TimestampTest extends \PHPUnit\Framework\TestCase
{
    public function test__Timestamp_not_set()
    {
        $user = new \Model\User();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';

        $this->assertEquals(true, \Validator\User::validateExists($user));
    }

    public function test__Timestamp_is_empty()
    {
        $user = new \Model\User();
        $user->id = 13;
        $user->username = 'boris';
        $user->name = 'Boris Bro';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '';

        $this->assertEquals(true, \Validator\User::validateExists($user));
        $this->assertEquals(null, $user->createdAt);
    }
}
