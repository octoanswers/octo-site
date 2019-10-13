<?php

class Mapper_User__save__negative__email__Test extends \Test\TestCase\DB
{
    public function test_notSet()
    {
        $user = new \Model\User();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "email" property null must be a string');
        $user = (new \Mapper\User())->update($user);
    }

    public function test_incorrect()
    {
        $user = new \Model\User();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->email = 'steve_aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "email" property "steve_aw.org" must be valid email');
        $user = (new \Mapper\User())->update($user);
    }
}
