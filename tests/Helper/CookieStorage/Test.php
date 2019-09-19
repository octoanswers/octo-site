<?php

use PHPUnit\Framework\TestCase;

class CookieStorage__Test extends TestCase
{
    protected function setUp(): void
    {
        $user = \Model\User::init_with_DB_state([
            'u_id'         => 13,
            'u_name'       => 'Joe Milk',
            'u_email'      => 'joe@answeropedia.org',
            'u_created_at' => '2016-03-19 06:47:41',
        ]);

        $this->storage = new \Helper\CookieStorage();
        $this->storage->save_user($user);
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
        $user = $this->storage->get_auth_user();

        $this->assertEquals('Joe Milk', $user->name);
        $this->assertEquals('joe@answeropedia.org', $user->email);
    }
}
