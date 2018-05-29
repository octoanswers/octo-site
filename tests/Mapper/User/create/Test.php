<?php

class Mapper_User_Create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_CreateUserWithFullParams_Ok()
    {
        $user = new User_Model();
        $user->setUsername('steve');
        $user->setName('Steve Bo');
        $user->setSignature('JS Dev');
        $user->setSite('http://example43.com');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');
        $user->setCreatedAt('2016-03-19 06:47:41');

        $user = (new User_Mapper())->create($user);

        $this->assertEquals(16, $user->getID());
        $this->assertEquals('steve', $user->getUsername());
        $this->assertEquals('Steve Bo', $user->getName());
        $this->assertEquals('steve@aw.org', $user->getEmail());
        $this->assertEquals('http://example43.com', $user->getSite());
        $this->assertEquals('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', $user->getPasswordHash());
        $this->assertEquals('4447243e3e1766375d23b06bf6dd1271', $user->getAPIKey());
    }
}
