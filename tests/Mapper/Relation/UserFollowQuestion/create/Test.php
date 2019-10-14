<?php

namespace Test\Mapper\Relation\UserFollowQuestion\create;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_users_follow_questions']];

    public function test__FullParams__OK()
    {
        $er = new \Model\Relation\UserFollowQuestion();
        $er->userID = 3;
        $er->questionID = 19;

        $er = (new \Mapper\Relation\UserFollowQuestion('ru'))->create($er);

        $this->assertEquals(9, $er->id);
        $this->assertEquals(3, $er->userID);
        $this->assertEquals(19, $er->questionID);
    }
}
