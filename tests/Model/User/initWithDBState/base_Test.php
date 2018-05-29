<?php

class Model_User_initWithDBState_Test extends PHPUnit\Framework\TestCase
{
    public function test_FullParams()
    {
        $user = User_Model::initWithDBState([
            'u_id' => 13,
            'u_username' => 'steve',
            'u_name' => 'Steve Bo',
            'u_email' => 'steve@aw.org',
            'u_signature' => 'PHP Programmer',
            'u_site' => 'http://site56.com/steve',
            'u_password_hash' => '$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy',
            'u_api_key' => '4447243e3e1766375d23b06bf6dd1271',
            'u_created_at' => '2016-03-19 06:47:41',
        ]);

        $this->assertEquals(13, $user->getID());
        $this->assertEquals('steve', $user->getUsername());
        $this->assertEquals('Steve Bo', $user->getName());
        $this->assertEquals('steve@aw.org', $user->getEmail());
        $this->assertEquals('PHP Programmer', $user->getSignature());
        $this->assertEquals('http://site56.com/steve', $user->getSite());
        $this->assertEquals('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', $user->getPasswordHash());
        $this->assertEquals('4447243e3e1766375d23b06bf6dd1271', $user->getAPIKey());
        $this->assertEquals('2016-03-19 06:47:41', $user->getCreatedAt());
    }

    public function test_MinParams()
    {
        $user = User_Model::initWithDBState([
            'u_id' => 13,
            'u_username' => 'steve',
            'u_name' => 'Steve Bo',
            'u_email' => 'steve@aw.org',
        ]);

        $this->assertEquals(13, $user->getID());
        $this->assertEquals('steve', $user->getUsername());
        $this->assertEquals('Steve Bo', $user->getName());
        $this->assertEquals('steve@aw.org', $user->getEmail());
        $this->assertEquals(null, $user->getSignature());
        $this->assertEquals(null, $user->getSite());
        $this->assertEquals(null, $user->getPasswordHash());
        $this->assertEquals(null, $user->getAPIKey());
    }
}
