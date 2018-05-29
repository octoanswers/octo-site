<?php

class Validator_User_validate_id_Test extends PHPUnit\Framework\TestCase
{
    public function test_idNotSet()
    {
        $user = new User_Model();
        $user->setName('Boris Bro');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');

        $this->expectExceptionMessage('User id param null must be of the type integer');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_IDEqualZero()
    {
        $user = new User_Model();
        $user->setID(0);
        $user->setName('Boris Bro');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');

        $this->expectExceptionMessage('User id param 0 must be greater than or equal to 1');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }

    public function test_IDBelowZero()
    {
        $user = new User_Model();
        $user->setID(-1);
        $user->setName('Boris Bro');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');

        $this->expectExceptionMessage('User id param -1 must be greater than or equal to 1');
        $this->assertEquals(true, User_Validator::validateExists($user));
    }
}
