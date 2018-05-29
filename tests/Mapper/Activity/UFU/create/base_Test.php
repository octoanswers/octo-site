<?php

class Mapper_Activities__createUFU__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new User_Model;
        $user->setID(46);
        $user->setName('Steve Bo');

        $followedUser = new User_Model;
        $followedUser->setID(6);
        $followedUser->setName('Steve Bar');

        $activity = new Activity_Model();
        $activity->setType(Activity_Model::F_U_FOLLOW_U);
        $activity->setSubject($user);
        $activity->setData($followedUser);

        $activity = (new UFollowU_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->getID());
        $this->assertEquals(Activity_Model::F_U_FOLLOW_U, $activity->getType());
    }
}
