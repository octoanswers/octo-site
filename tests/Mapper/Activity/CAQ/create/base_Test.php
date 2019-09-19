<?php

class Mapper_Activity_CAQ__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $category = \Model\Category::init_with_title('tag1102');

        $question = \Model\Question::init_with_title('Когда закончится дождь?');

        $activity = new \Model\Activity();
        $activity->type = \Model\Activity::CATEGORY_ADDED_QUESTION;
        $activity->subject = $category;
        $activity->data = $question;

        $activity = (new CAddedQ_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(\Model\Activity::CATEGORY_ADDED_QUESTION, $activity->type);
    }
}
