<?php

class Query_Relations_UsersFollowUsers__find_users_followed_by_userTest extends \Tests\DB\TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_users']];

    public function test__Relation_exists()
    {
        $followed = (new \Query\Relations\UsersFollowUsers('ru'))->find_users_followed_by_user(4);

        $this->assertEquals(1, $followed[0]);
        $this->assertEquals(5, $followed[1]);
        $this->assertEquals(7, $followed[2]);

        $this->assertEquals(3, count($followed));
    }

    public function test__Relation_not_exists()
    {
        $followed = (new \Query\Relations\UsersFollowUsers('ru'))->find_users_followed_by_user(12);

        $this->assertEquals(0, count($followed));
    }
}
