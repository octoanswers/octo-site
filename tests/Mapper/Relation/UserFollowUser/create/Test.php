<?php

class UserFollowUser_Relation_Mapper__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_users']];

    public function test__FullParams__OK()
    {
        $relation = new UserFollowUser_Relation_Model();
        $relation->userID = 3;
        $relation->setFollowedUserID(19);

        $relation = (new UserFollowUser_Relation_Mapper('ru'))->create($relation);

        $this->assertEquals(8, $relation->getID());
        $this->assertEquals(3, $relation->userID);
        $this->assertEquals(19, $relation->getFollowedUserID());
    }
}
