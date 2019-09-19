<?php

class UserFollowUser_Relation_Mapper__delete_relation__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_users']];

    public function test__FullParams__OK()
    {
        // Relation must be in DB
        $relation = new \Model\Relation\UserFollowUser();
        $relation->id = 3;
        $relation->userID = 4;
        $relation->followedUserID = 5;
        $relation->createdAt = '2014-12-16 11:28:56';

        $deleted = (new \Mapper\Relation\UserFollowUser('ru'))->delete_relation($relation);

        $this->assertEquals(true, $deleted);
    }

    public function test__RelationNotExists()
    {
        // Not exists relation
        $relation = new \Model\Relation\UserFollowUser();
        $relation->id = 6;
        $relation->userID = 22;
        $relation->followedUserID = 61;
        $relation->createdAt = '2014-12-16 11:28:56';

        $this->expectExceptionMessage('UserFollowUser relation not deleted');
        $deleted = (new \Mapper\Relation\UserFollowUser('ru'))->delete_relation($relation);
    }
}
