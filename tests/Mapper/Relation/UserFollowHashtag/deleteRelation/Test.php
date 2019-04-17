<?php

class UserFollowHashtag_Relation_Mapper__deleteRelation__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_hashtags']];

    public function test__FullParams__OK()
    {
        // Relation must be in DB
        $relation = new UserFollowHashtag_Relation_Model();
        $relation->setID(6);
        $relation->userID = 2;
        $relation->setHashtagID(16);
        $relation->createdAt = '2014-12-16 11:28:56';

        $deleted = (new UserFollowHashtag_Relation_Mapper('ru'))->deleteRelation($relation);

        $this->assertEquals(true, $deleted);
    }

    public function test__RelationNotExists()
    {
        // Not exists relation
        $relation = new UserFollowHashtag_Relation_Model();
        $relation->setID(6);
        $relation->userID = 22;
        $relation->setHashtagID(61);
        $relation->createdAt = '2014-12-16 11:28:56';

        $this->expectExceptionMessage('UserFollowHashtag relation not deleted');
        $deleted = (new UserFollowHashtag_Relation_Mapper('ru'))->deleteRelation($relation);
    }
}
