<?php

class Query_Relations_UsersFollowUsers__relation_with_user_ID_and_followed_user_IDTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_users_follow_users']];

    public function test__Relation_exists()
    {
        $relation = (new \Query\Relations\UsersFollowUsers('ru'))->relation_with_user_ID_and_followed_user_ID(4, 5);

        $this->assertEquals(3, $relation->id);
        $this->assertEquals(4, $relation->userID);
        $this->assertEquals(5, $relation->followedUserID);
        $this->assertEquals('2015-12-16 13:28:56', $relation->createdAt);
    }

    public function test__Relation_not_exists()
    {
        $relation = (new \Query\Relations\UsersFollowUsers('ru'))->relation_with_user_ID_and_followed_user_ID(3, 99);
        $this->assertEquals(null, $relation);
    }
}
