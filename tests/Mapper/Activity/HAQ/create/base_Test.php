<?php

class Mapper_Activity_HAQ__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $category = Category::initWithTitle('tag1102');

        $question = Question_Model::initWithTitle('Когда закончится дождь?');

        $activity = new Activity_Model();
        $activity->type = Activity_Model::F_H_ADDED_Q;
        $activity->subject = $category;
        $activity->data = $question;

        $activity = (new HAddedQ_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(Activity_Model::F_H_ADDED_Q, $activity->type);
    }
}
