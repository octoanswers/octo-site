<?php

namespace Test\Mapper\User\create;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function test_CreateUserWithFullParams_Ok()
    {
        $user = new \Model\User();
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'JS Dev';
        $user->site = 'http://example43.com';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $user = (new \Mapper\User())->create($user);

        $this->assertEquals(16, $user->id);
        $this->assertEquals('steve', $user->username);
        $this->assertEquals('Steve Bo', $user->name);
        $this->assertEquals('steve@aw.org', $user->email);
        $this->assertEquals('http://example43.com', $user->site);
        $this->assertEquals('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', $user->passwordHash);
        $this->assertEquals('4447243e3e1766375d23b06bf6dd1271', $user->apiKey);
    }
}
