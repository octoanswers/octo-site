<?php

class Mapper_Activity_URenameQ__create__Test extends \Tests\DB\TestCase
{
    protected $setUpDB = ['ru' => ['activities', 'questions']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new \Model\User();
        $user->id = 46;
        $user->name = 'Steve Bo';

        $question = (new \Query\Question('ru'))->question_with_ID(6);

        $activity = new \Model\Activity();
        $activity->type = \Model\Activity::U_RENAME_Q;
        $activity->subject = $user;
        $activity->data = ['question' => $question, 'old_title' => 'Как ты?'];

        $activity = (new \Mapper\Activity\URenameQ('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(\Model\Activity::U_RENAME_Q, $activity->type);
    }
}
