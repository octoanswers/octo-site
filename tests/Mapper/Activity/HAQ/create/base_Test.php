<?php

class Mapper_Activity_HAQ__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $topic = Hashtag_Model::initWithTitle('tag1102');

        $question = Question_Model::initWithTitle('Когда закончится дождь?');

        $activity = new Activity_Model();
        $activity->setType(Activity_Model::F_H_ADDED_Q);
        $activity->setSubject($topic);
        $activity->setData($question);

        $activity = (new HAddedQ_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->getID());
        $this->assertEquals(Activity_Model::F_H_ADDED_Q, $activity->getType());
    }
}
