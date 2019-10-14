<?php

namespace Test\Mapper\Activity\URenameQ\create;

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
        $activity->type = \Model\Activity::U_RENAME_Q;
        $activity->subject = $user;
        $activity->data = ['question' => $question, 'old_title' => 'Как ты?'];

        $activity = (new \Mapper\Activity\URenameQ('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(\Model\Activity::U_RENAME_Q, $activity->type);
    }
}
