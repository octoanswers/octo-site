<?php

namespace Test\Query\Relations\UsersFollowCategories\findCategoriesFollowedByUser;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_users_follow_categories']];

    public function test__Relation_exists()
    {
        $followed = (new \Query\Relations\UsersFollowCategories('ru'))->findCategoriesFollowedByUser(7);

        $this->assertEquals(22, $followed[0]);
        $this->assertEquals(15, $followed[1]);

        $this->assertEquals(2, count($followed));
    }

    public function test__Relation_not_exists()
    {
        $followed = (new \Query\Relations\UsersFollowCategories('ru'))->findCategoriesFollowedByUser(12);

        $this->assertEquals(0, count($followed));
    }
}
