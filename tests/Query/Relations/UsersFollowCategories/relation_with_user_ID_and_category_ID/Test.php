<?php

class Query_Relations_UsersFollowCategories__relation_with_user_ID_and_category_IDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_categories']];

    public function test__Relation_exists()
    {
        $relation = (new UsersFollowCategories_Relations_Query('ru'))->relation_with_user_ID_and_category_ID(2, 16);

        $this->assertEquals(6, $relation->id);
        $this->assertEquals(2, $relation->userID);
        $this->assertEquals(16, $relation->categoryID);
        $this->assertEquals('2014-12-16 11:28:56', $relation->createdAt);
    }

    public function test__Relation_not_exists()
    {
        $relation = (new UsersFollowCategories_Relations_Query('ru'))->relation_with_user_ID_and_category_ID(3, 99);

        $this->assertEquals(null, $relation);
    }
}
