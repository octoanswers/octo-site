<?php

namespace Test\Query\Relations\UsersFollowCategories\relationWithUserIDAndCategoryID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_users_follow_categories']];

    public function test__Relation_exists()
    {
        $relation = (new \Query\Relations\UsersFollowCategories('ru'))->relationWithUserIDAndCategoryID(2, 16);

        $this->assertEquals(6, $relation->id);
        $this->assertEquals(2, $relation->userID);
        $this->assertEquals(16, $relation->categoryID);
        $this->assertEquals('2014-12-16 11:28:56', $relation->createdAt);
    }

    public function test__Relation_not_exists()
    {
        $relation = (new \Query\Relations\UsersFollowCategories('ru'))->relationWithUserIDAndCategoryID(3, 99);

        $this->assertEquals(null, $relation);
    }
}
