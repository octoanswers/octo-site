<?php

class Mapper_Activities__createUFU__Test extends \Tests\DB\TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new \Model\User();
        $user->id = 46;
        $user->name = 'Steve Bo';

        $followedUser = new \Model\User();
        $followedUser->id = 6;
        $followedUser->name = 'Steve Bar';

        $activity = new \Model\Activity();
        $activity->type = \Model\Activity::F_U_FOLLOW_U;
        $activity->subject = $user;
        $activity->data = $followedUser;

        $activity = (new \Mapper\Activity\UFollowU('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(\Model\Activity::F_U_FOLLOW_U, $activity->type);
    }
}
