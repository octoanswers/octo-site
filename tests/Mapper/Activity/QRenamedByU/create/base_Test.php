<?php

class Mapper_Activity_QRenamedByU__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities', 'questions']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new \Model\User();
        $user->id = 46;
        $user->name = 'Steve Bo';

        $question = (new Question_Query('ru'))->question_with_ID(6);

        $activity = new \Model\Activity();
        $activity->type = \Model\Activity::Q_RENAMED_BY_U;
        $activity->subject = $question;
        $activity->data = ['user' => $user, 'old_title' => 'Как ты?'];

        $activity = (new QRenamedByU_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(\Model\Activity::Q_RENAMED_BY_U, $activity->type);
    }
}
