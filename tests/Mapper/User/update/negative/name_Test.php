<?php

class Mapper_User__save__negative__name__Test extends \Test\TestCase\DB
{
    public function test_empty()
    {
        $user = new \Model\User();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = '';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "name" property "" must have a length between 2 and 255');
        $user = (new \Mapper\User())->update($user);
    }

    public function test_tooShort()
    {
        $user = new \Model\User();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'S';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "name" property "S" must have a length between 2 and 255');
        $user = (new \Mapper\User())->update($user);
    }

    public function test_tooLong()
    {
        $user = new \Model\User();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve...';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "name" property "Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve... Steve..." must have a length between 2 and 255');
        $user = (new \Mapper\User())->update($user);
    }
}
