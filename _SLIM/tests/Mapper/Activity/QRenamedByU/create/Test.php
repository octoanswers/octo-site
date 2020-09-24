<?php

namespace Test\Mapper\Activity\QRenamedByU\create;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['activities', 'questions']];

    public function test__Create_with_full_params()
    {
        $user = new \Model\User();
        $user->id = 46;
        $user->name = 'Steve Bo';

        $question = (new \Query\Question('ru'))->questionWithID(6);

        $activity = new \Model\Activity();
        $activity->type = \Model\Activity::Q_RENAMED_BY_U;
        $activity->subject = $question;
        $activity->data = ['user' => $user, 'old_title' => 'Как ты?'];

        $activity = (new \Mapper\Activity\QRenamedByU('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(\Model\Activity::Q_RENAMED_BY_U, $activity->type);
    }
}
