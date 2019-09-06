<?php

class Query_Relations_UsersFollowCategories__find_categories_followed_by_userTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_categories']];

    public function test__Relation_exists()
    {
        $followed = (new UsersFollowCategories_Relations_Query('ru'))->find_categories_followed_by_user(7);

        $this->assertEquals(22, $followed[0]);
        $this->assertEquals(15, $followed[1]);

        $this->assertEquals(2, count($followed));
    }

    public function test__Relation_not_exists()
    {
        $followed = (new UsersFollowCategories_Relations_Query('ru'))->find_categories_followed_by_user(12);

        $this->assertEquals(0, count($followed));
    }
}
