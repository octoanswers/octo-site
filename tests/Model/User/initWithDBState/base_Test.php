<?php

class Model_User_init_with_DB_state_Test extends PHPUnit\Framework\TestCase
{
    public function test_FullParams()
    {
        $user = User_Model::init_with_DB_state([
            'u_id'            => 13,
            'u_username'      => 'steve',
            'u_name'          => 'Steve Bo',
            'u_email'         => 'steve@aw.org',
            'u_signature'     => 'PHP Programmer',
            'u_site'          => 'http://site56.com/steve',
            'u_password_hash' => '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy',
            'u_api_key'       => '4447243e3e1766375d23b06bf6dd1271',
            'u_created_at'    => '2016-03-19 06:47:41',
        ]);

        $this->assertEquals(13, $user->id);
        $this->assertEquals('steve', $user->username);
        $this->assertEquals('Steve Bo', $user->name);
        $this->assertEquals('steve@aw.org', $user->email);
        $this->assertEquals('PHP Programmer', $user->signature);
        $this->assertEquals('http://site56.com/steve', $user->site);
        $this->assertEquals('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', $user->passwordHash);
        $this->assertEquals('4447243e3e1766375d23b06bf6dd1271', $user->apiKey);
        $this->assertEquals('2016-03-19 06:47:41', $user->createdAt);
    }

    public function test_MinParams()
    {
        $user = User_Model::init_with_DB_state([
            'u_id'         => 13,
            'u_username'   => 'steve',
            'u_name'       => 'Steve Bo',
            'u_email'      => 'steve@aw.org',
            'u_created_at' => '2016-03-19 06:47:41',
        ]);

        $this->assertEquals(13, $user->id);
        $this->assertEquals('steve', $user->username);
        $this->assertEquals('Steve Bo', $user->name);
        $this->assertEquals('steve@aw.org', $user->email);
        $this->assertEquals(null, $user->signature);
        $this->assertEquals(null, $user->site);
        $this->assertEquals(null, $user->passwordHash);
        $this->assertEquals(null, $user->apiKey);
    }
}
