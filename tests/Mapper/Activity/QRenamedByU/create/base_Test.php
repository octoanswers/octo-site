<?php

class Mapper_Activity_QRenamedByU__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities', 'questions']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new User_Model;
        $user->setID(46);
        $user->setName('Steve Bo');

        $question = (new Question_Query('ru'))->questionWithID(6);

        $activity = new Activity_Model();
        $activity->setType(Activity_Model::Q_RENAMED_BY_U);
        $activity->setSubject($question);
        $activity->setData(['user' => $user, 'old_title' => 'Как ты?']);

        $activity = (new QRenamedByU_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->getID());
        $this->assertEquals(Activity_Model::Q_RENAMED_BY_U, $activity->getType());
    }
}
