<?php

class UsersFollowCategories_Relations_Query__relation_with_user_ID_and_category_ID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_categories']];

    public function test__RelationExists()
    {
        $relation = (new UsersFollowCategories_Relations_Query('ru'))->relation_with_user_ID_and_category_ID(2, 16);

        $this->assertEquals(6, $relation->id);
        $this->assertEquals(2, $relation->userID);
        $this->assertEquals(16, $relation->categoryID);
        $this->assertEquals('2014-12-16 11:28:56', $relation->createdAt);
    }

    public function test__RelationNotExists()
    {
        $relation = (new UsersFollowCategories_Relations_Query('ru'))->relation_with_user_ID_and_category_ID(3, 99);

        $this->assertEquals(null, $relation);
    }
}
