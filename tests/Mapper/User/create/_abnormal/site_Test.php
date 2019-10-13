<?php

class Mapper_User_create__site__Test extends \Tests\DB\TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_SiteNotSet()
    {
        $user = new \Model\User();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $user = (new \Mapper\User())->create($user);
        $this->assertEquals(null, $user->site);
    }
}
