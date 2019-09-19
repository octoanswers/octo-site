<?php

class UserFollowQuestion_Relation_Mapper__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_users_follow_questions']];

    public function test__FullParams__OK()
    {
        $er = new \Model\Relation\UserFollowQuestion();
        $er->userID = 3;
        $er->questionID = 19;

        $er = (new UserFollowQuestion_Relation_Mapper('ru'))->create($er);

        $this->assertEquals(9, $er->id);
        $this->assertEquals(3, $er->userID);
        $this->assertEquals(19, $er->questionID);
    }
}
