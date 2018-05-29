<?php

class Mapper_User__update__site__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function test_SiteNotSet()
    {
        $user = new User_Model();
        $user->setID(7);
        $user->setUsername('steve');
        $user->setName('Steve Bo');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('$2a$10$3f6bd68f206c46e04c8ecOVlP228zJXYjSbuVRiEMhoIWxjWkzcvy');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');
        $user->setCreatedAt('2016-03-19 06:47:41');

        $user = (new User_Mapper())->update($user);
        $this->assertEquals(null, $user->getSite());
    }
}
