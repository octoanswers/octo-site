<?php

namespace Test\Mapper\Relation\UserFollowUser\create;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_users_follow_users']];

    public function test__Full_params()
    {
        $relation = new \Model\Relation\UserFollowUser();
        $relation->userID = 3;
        $relation->followedUserID = 19;

        $relation = (new \Mapper\Relation\UserFollowUser('ru'))->create($relation);

        $this->assertEquals(8, $relation->id);
        $this->assertEquals(3, $relation->userID);
        $this->assertEquals(19, $relation->followedUserID);
    }
}
