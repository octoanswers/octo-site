<?php

namespace Test\Query\User\userWithAPIKey;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['users' => ['users']];

    public function testCorrectLogin()
    {
        $user = (new \Query\User())->userWithAPIKey('7d21ebdbec3d4e396043c96b6ab44a6e');

        $this->assertEquals(3, $user->id);
        $this->assertEquals('ivan', $user->username);
        $this->assertEquals('Иван Коршунов', $user->name);
        $this->assertEquals('admin@answeropedia.org', $user->email);
        $this->assertEquals('2016-03-19 06:47:41', $user->createdAt);
    }
}
