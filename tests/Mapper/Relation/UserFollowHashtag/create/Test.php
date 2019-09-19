<?php

class UserFollowCategory_Relation_Mapper__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_categories']];

    public function test__FullParams__OK()
    {
        $relation = new \Model\Relation\UserFollowCategory();
        $relation->userID = 3;
        $relation->categoryID = 19;

        $relation = (new UserFollowCategory_Relation_Mapper('ru'))->create($relation);

        $this->assertEquals(12, $relation->id);
        $this->assertEquals(3, $relation->userID);
        $this->assertEquals(19, $relation->categoryID);
    }
}
