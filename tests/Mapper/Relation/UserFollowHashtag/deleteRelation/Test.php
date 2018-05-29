<?php

class UserFollowTopic_Relation_Mapper__deleteRelation__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_topics']];

    public function test__FullParams__OK()
    {
        // Relation must be in DB
        $relation = new UserFollowTopic_Relation_Model();
        $relation->setID(6);
        $relation->setUserID(2);
        $relation->setTopicID(16);
        $relation->setCreatedAt('2014-12-16 11:28:56');

        $deleted = (new UserFollowTopic_Relation_Mapper('ru'))->deleteRelation($relation);

        $this->assertEquals(true, $deleted);
    }

    public function test__RelationNotExists()
    {
        // Not exists relation
        $relation = new UserFollowTopic_Relation_Model();
        $relation->setID(6);
        $relation->setUserID(22);
        $relation->setTopicID(61);
        $relation->setCreatedAt('2014-12-16 11:28:56');

        $this->expectExceptionMessage('UserFollowTopic relation not deleted');
        $deleted = (new UserFollowTopic_Relation_Mapper('ru'))->deleteRelation($relation);
    }
}
