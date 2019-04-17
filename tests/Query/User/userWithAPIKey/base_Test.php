<?php

class Query_Users_userWithAPIKey_Base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['users' => ['users']];

    public function testCorrectLogin()
    {
        $user = (new User_Query())->userWithAPIKey('7d21ebdbec3d4e396043c96b6ab44a6e');

        $this->assertEquals(3, $user->getID());
        $this->assertEquals('ivan', $user->getUsername());
        $this->assertEquals('Иван Коршунов', $user->getName());
        $this->assertEquals('admin@answeropedia.org', $user->email);
        $this->assertEquals('2016-03-19 06:47:41', $user->createdAt);
    }
}
