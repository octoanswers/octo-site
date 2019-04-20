<?php

class Mapper_Activity_URenameQ__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities', 'questions']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new User_Model;
        $user->id = 46;
        $user->name = 'Steve Bo';

        $question = (new Question_Query('ru'))->questionWithID(6);

        $activity = new Activity_Model();
        $activity->type = Activity_Model::U_RENAME_Q;
        $activity->subject = $user;
        $activity->data = ['question' => $question, 'old_title' => 'Как ты?'];

        $activity = (new URenameQ_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(Activity_Model::U_RENAME_Q, $activity->type);
    }
}
