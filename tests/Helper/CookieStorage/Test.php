<?php

namespace Test\Helper\CookieStorage;

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    protected function setUp(): void
    {
        $user = \Model\User::initWithDBState([
            'u_id'         => 13,
            'u_name'       => 'Joe Milk',
            'u_email'      => 'joe@answeropedia.org',
            'u_created_at' => '2016-03-19 06:47:41',
        ]);

        $this->storage = new \Helper\CookieStorage();
        $this->storage->saveUser($user);
    }

    public function tearDown(): void
    {
        $this->storage->clear();
        $this->storage = null;
    }

    public function test__class()
    {
        $this->assertInstanceOf('\Helper\CookieStorage', $this->storage);
    }

    public function testConstValues()
    {
        $user = $this->storage->getAuthUser();

        $this->assertEquals('Joe Milk', $user->name);
        $this->assertEquals('joe@answeropedia.org', $user->email);
    }
}
