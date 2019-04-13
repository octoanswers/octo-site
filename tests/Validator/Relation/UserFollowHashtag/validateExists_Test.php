<?php

class UserFollowHashtag_Relation_Validator__validateExists__Test extends PHPUnit\Framework\TestCase
{
    public function test__FullParams__OK()
    {
        $relation = new UserFollowHashtag_Relation_Model();
        $relation->setID(13);
        $relation->setUserID(3);
        $relation->setHashtagID(9);
        $relation->setCreatedAt('2015-11-29 09:28:34');

        $this->assertEquals(true, UserFollowHashtag_Relation_Validator::validateExists($relation));
    }

    public function test__MinParams__OK()
    {
        $relation = new UserFollowHashtag_Relation_Model();
        $relation->setID(13);
        $relation->setUserID(3);
        $relation->setHashtagID(9);

        $this->assertEquals(true, UserFollowHashtag_Relation_Validator::validateExists($relation));
    }
}
