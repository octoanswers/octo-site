<?php

class Mapper_User__update__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_UpdateUserWithFullParams_Ok()
    {
        $user = new \Model\User();
        $user->id = 11;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->email = 'steve@aw.org';
        $user->signature = 'Ktulhu';
        $user->site = 'http://example43.com';
        $user->passwordHash = '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->is_avatar_uploaded = true;

        $user = (new \Mapper\User())->update($user);

        $this->assertEquals(11, $user->id);
        $this->assertEquals('steve', $user->username);
        $this->assertEquals('Steve Bo', $user->name);
        $this->assertEquals('steve@aw.org', $user->email);
        $this->assertEquals('Ktulhu', $user->signature);
        $this->assertEquals(true, $user->is_avatar_uploaded);
        $this->assertEquals('http://example43.com', $user->site);
        $this->assertEquals('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', $user->passwordHash);
        $this->assertEquals('4447243e3e1766375d23b06bf6dd1271', $user->apiKey);
    }
}
