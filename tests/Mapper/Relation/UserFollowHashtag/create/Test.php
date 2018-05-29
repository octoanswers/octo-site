<?php

class UserFollowTopic_Relation_Mapper__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_topics']];

    public function test__FullParams__OK()
    {
        $relation = new UserFollowTopic_Relation_Model();
        $relation->setUserID(3);
        $relation->setTopicID(19);

        $relation = (new UserFollowTopic_Relation_Mapper('ru'))->create($relation);

        $this->assertEquals(12, $relation->getID());
        $this->assertEquals(3, $relation->getUserID());
        $this->assertEquals(19, $relation->getTopicID());
    }
}
