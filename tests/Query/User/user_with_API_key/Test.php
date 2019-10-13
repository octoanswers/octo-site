<?php

class Query_Users__user_with_API_keyTest extends \Tests\DB\TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testCorrectLogin()
    {
        $user = (new \Query\User())->user_with_API_key('7d21ebdbec3d4e396043c96b6ab44a6e');

        $this->assertEquals(3, $user->id);
        $this->assertEquals('ivan', $user->username);
        $this->assertEquals('Иван Коршунов', $user->name);
        $this->assertEquals('admin@answeropedia.org', $user->email);
        $this->assertEquals('2016-03-19 06:47:41', $user->createdAt);
    }
}
