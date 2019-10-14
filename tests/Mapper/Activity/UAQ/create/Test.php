<?php

namespace Test\Mapper\Activity\UAQ\create;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test__Create_with_full_params()
    {
        $user = new \Model\User();
        $user->id = 46;
        $user->name = 'Steve Bo';

        $question = \Model\Question::initWithTitle('Когда закончится дождь?');

        $activity = new \Model\Activity();
        $activity->type = \Model\Activity::F_U_ASKED_Q;
        $activity->subject = $user;
        $activity->data = $question;

        $activity = (new \Mapper\Activity\UAskedQ('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(\Model\Activity::F_U_ASKED_Q, $activity->type);
    }
}
