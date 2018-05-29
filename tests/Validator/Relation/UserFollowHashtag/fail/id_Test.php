<?php

class UserFollowTopic_Relation_Validator__id__Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $relation = new UserFollowTopic_Relation_Model();
        $relation->setID(0);
        $relation->setUserID(3);
        $relation->setTopicID(9);

        $this->expectExceptionMessage('UserFollowTopic relation "id" property 0 must be greater than or equal to 1');
        UserFollowTopic_Relation_Validator::validateExists($relation);
    }

    public function test__IDBelowZero()
    {
        $relation = new UserFollowTopic_Relation_Model();
        $relation->setID(-1);
        $relation->setUserID(3);
        $relation->setTopicID(9);

        $this->expectExceptionMessage('UserFollowTopic relation "id" property -1 must be greater than or equal to 1');
        UserFollowTopic_Relation_Validator::validateExists($relation);
    }
}
