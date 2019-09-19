<?php

class Validator_User__validate_exists__negative__idTest extends PHPUnit\Framework\TestCase
{
    public function test__ID_not_set()
    {
        $user = new \Model\User();
        $user->name = 'Boris Bro';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';

        $this->expectExceptionMessage('User id param null must be of the type integer');
        $this->assertEquals(true, \Validator\User::validate_exists($user));
    }

    public function test__ID_equal_zero()
    {
        $user = new \Model\User();
        $user->id = 0;
        $user->name = 'Boris Bro';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';

        $this->expectExceptionMessage('User id param 0 must be greater than or equal to 1');
        $this->assertEquals(true, \Validator\User::validate_exists($user));
    }

    public function test__ID_below_zero()
    {
        $user = new \Model\User();
        $user->id = -1;
        $user->name = 'Boris Bro';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';

        $this->expectExceptionMessage('User id param -1 must be greater than or equal to 1');
        $this->assertEquals(true, \Validator\User::validate_exists($user));
    }
}
