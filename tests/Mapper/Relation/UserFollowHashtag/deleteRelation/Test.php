<?php

class UserFollowCategory_Relation_Mapper__delete_relation__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_categories']];

    public function test__FullParams__OK()
    {
        // Relation must be in DB
        $relation = new \Model\Relation\UserFollowCategory();
        $relation->id = 6;
        $relation->userID = 2;
        $relation->categoryID = 16;
        $relation->createdAt = '2014-12-16 11:28:56';

        $deleted = (new \Mapper\Relation\UserFollowCategory('ru'))->delete_relation($relation);

        $this->assertEquals(true, $deleted);
    }

    public function test__RelationNotExists()
    {
        // Not exists relation
        $relation = new \Model\Relation\UserFollowCategory();
        $relation->id = 6;
        $relation->userID = 22;
        $relation->categoryID = 61;
        $relation->createdAt = '2014-12-16 11:28:56';

        $this->expectExceptionMessage('UserFollowCategory relation not deleted');
        $deleted = (new \Mapper\Relation\UserFollowCategory('ru'))->delete_relation($relation);
    }
}
