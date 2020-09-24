<?php

namespace Test\Query\Relations\UsersFollowUsers\relationWithUserIDAndFollowedUserID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_users_follow_users']];

    public function test__Relation_exists()
    {
        $relation = (new \Query\Relations\UsersFollowUsers('ru'))->relationWithUserIDAndFollowedUserID(4, 5);

        $this->assertEquals(3, $relation->id);
        $this->assertEquals(4, $relation->userID);
        $this->assertEquals(5, $relation->followedUserID);
        $this->assertEquals('2015-12-16 13:28:56', $relation->createdAt);
    }

    public function test__Relation_not_exists()
    {
        $relation = (new \Query\Relations\UsersFollowUsers('ru'))->relationWithUserIDAndFollowedUserID(3, 99);
        $this->assertEquals(null, $relation);
    }
}
