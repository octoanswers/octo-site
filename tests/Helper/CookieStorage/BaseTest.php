<?php

use PHPUnit\Framework\TestCase;

class CookieStorage_BaseTest extends TestCase
{
    protected function setUp()
    {
        $user = User_Model::initWithDBState([
            'u_id' => 13,
            'u_name' => 'Joe Milk',
            'u_email' => 'joe@octoanswers.com',
            'u_created_at' => '2016-03-19 06:47:41',
        ]);

        $this->storage = new CookieStorage();
        $this->storage->saveUser($user);
    }

    public function tearDown()
    {
        $this->storage->clear();
        $this->storage = null;
    }

    public function test__class()
    {
        $this->assertInstanceOf('CookieStorage', $this->storage);
    }

    public function testConstValues()
    {
        $user = $this->storage->getAuthUser();

        $this->assertEquals('Joe Milk', $user->getName());
        $this->assertEquals('joe@octoanswers.com', $user->getEmail());
    }
}
