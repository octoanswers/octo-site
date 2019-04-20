<?php

class Mapper_Activities__createUFU__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new User_Model;
        $user->id = 46;
        $user->name = 'Steve Bo';

        $followedUser = new User_Model;
        $followedUser->id = 6;
        $followedUser->name = 'Steve Bar';

        $activity = new Activity_Model();
        $activity->type = Activity_Model::F_U_FOLLOW_U;
        $activity->subject = $user;
        $activity->data = $followedUser;

        $activity = (new UFollowU_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(Activity_Model::F_U_FOLLOW_U, $activity->type);
    }
}
