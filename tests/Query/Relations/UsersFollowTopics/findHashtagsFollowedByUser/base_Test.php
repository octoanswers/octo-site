<?php

class UsersFollowQuestions_Relations_Query__findCategoriesFollowedByUser__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_categories']];

    public function test__RelationExists()
    {
        $followed = (new UsersFollowCategories_Relations_Query('ru'))->findCategoriesFollowedByUser(7);

        $this->assertEquals(22, $followed[0]);
        $this->assertEquals(15, $followed[1]);

        $this->assertEquals(2, count($followed));
    }

    public function test__RelationNotExists()
    {
        $followed = (new UsersFollowCategories_Relations_Query('ru'))->findCategoriesFollowedByUser(12);

        $this->assertEquals(0, count($followed));
    }
}
