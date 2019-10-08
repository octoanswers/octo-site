<?php

class Mapper_User__update__id__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_Update_user_with_not_exists_ID()
    {
        $user = new \Model\User();
        $user->id = 1352;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';

        $this->expectExceptionMessage('User not found');
        $user = (new \Mapper\User())->update($user);
    }

    public function test_Updateuser_with_IDEqualZero_ThrowException()
    {
        $user = new \Model\User();
        $user->id = 0;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User id param 0 must be greater than or equal to 1');
        $user = (new \Mapper\User())->update($user);
    }

    public function test_Updateuser_with_IDBelowZero_ThrowException()
    {
        $user = new \Model\User();
        $user->id = -1;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User id param -1 must be greater than or equal to 1');
        $user = (new \Mapper\User())->update($user);
    }
}
