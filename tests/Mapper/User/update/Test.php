<?php

class Mapper_User_Update_Base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_UpdateUserWithFullParams_Ok()
    {
        $user = new User_Model();
        $user->setID(11);
        $user->setUsername('steve');
        $user->setName('Steve Bo');
        $user->setEmail('steve@aw.org');
        $user->setSignature('Ktulhu');
        $user->setSite('http://example43.com');
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');

        $user = (new User_Mapper())->update($user);

        $this->assertEquals(11, $user->getID());
        $this->assertEquals('steve', $user->getUsername());
        $this->assertEquals('Steve Bo', $user->getName());
        $this->assertEquals('steve@aw.org', $user->getEmail());
        $this->assertEquals('Ktulhu', $user->getSignature());
        $this->assertEquals('http://example43.com', $user->getSite());
        $this->assertEquals('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy', $user->getPasswordHash());
        $this->assertEquals('4447243e3e1766375d23b06bf6dd1271', $user->getAPIKey());
    }
}
