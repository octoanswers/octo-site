<?php

class Mapper_Activity_UFQ__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new User_Model;
        $user->setID(46);
        $user->setName('Steve Bo');

        $question = Question_Model::initWithTitle('Когда закончится дождь?');

        $activity = new Activity_Model();
        $activity->setType(Activity_Model::F_U_FOLLOW_Q);
        $activity->setSubject($user);
        $activity->setData($question);

        $activity = (new UFollowQ_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->getID());
        $this->assertEquals(Activity_Model::F_U_FOLLOW_Q, $activity->getType());
    }
}
