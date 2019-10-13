<?php

class Mapper_User_save__negative__api_key__Test extends \Test\TestCase\DB
{
    public function test_notSet()
    {
        $user = new \Model\User();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "apiKey" property null must be a string');
        $user = (new \Mapper\User())->update($user);
    }

    public function test_tooShort()
    {
        $user = new \Model\User();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '123';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "apiKey" property "123" must have a length between 25 and 45');
        $user = (new \Mapper\User())->update($user);
    }

    public function test_tooLong()
    {
        $user = new \Model\User();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271+4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "apiKey" property "4447243e3e1766375d23b06bf6dd1271+4447243e3e1766375d23b06bf6dd1271" must have a length between 25 and 45');
        $user = (new \Mapper\User())->update($user);
    }
}
