<?php

namespace Test\Mapper\Relation\UserFollowCategory\create;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_users_follow_categories']];

    public function test__FullParams__OK()
    {
        $relation = new \Model\Relation\UserFollowCategory();
        $relation->userID = 3;
        $relation->categoryID = 19;

        $relation = (new \Mapper\Relation\UserFollowCategory('ru'))->create($relation);

        $this->assertEquals(12, $relation->id);
        $this->assertEquals(3, $relation->userID);
        $this->assertEquals(19, $relation->categoryID);
    }
}
