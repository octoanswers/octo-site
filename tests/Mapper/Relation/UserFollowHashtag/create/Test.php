<?php

class UserFollowHashtag_Relation_Mapper__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_hashtags']];

    public function test__FullParams__OK()
    {
        $relation = new UserFollowHashtag_Relation_Model();
        $relation->setUserID(3);
        $relation->setHashtagID(19);

        $relation = (new UserFollowHashtag_Relation_Mapper('ru'))->create($relation);

        $this->assertEquals(12, $relation->getID());
        $this->assertEquals(3, $relation->getUserID());
        $this->assertEquals(19, $relation->getHashtagID());
    }
}
