<?php

class Mapper_Activity_UFQ__create__Test extends \Tests\DB\TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new \Model\User();
        $user->id = 46;
        $user->name = 'Steve Bo';

        $question = \Model\Question::init_with_title('Когда закончится дождь?');

        $activity = new \Model\Activity();
        $activity->type = \Model\Activity::F_U_FOLLOW_Q;
        $activity->subject = $user;
        $activity->data = $question;

        $activity = (new \Mapper\Activity\UFollowQ('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(\Model\Activity::F_U_FOLLOW_Q, $activity->type);
    }
}
