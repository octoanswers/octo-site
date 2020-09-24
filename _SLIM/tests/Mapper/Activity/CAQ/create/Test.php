<?php

namespace Test\Mapper\Activity\CAQ\create;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test__Create_with_full_args()
    {
        $category = \Model\Category::initWithTitle('tag1102');

        $question = \Model\Question::initWithTitle('Когда закончится дождь?');

        $activity = new \Model\Activity();
        $activity->type = \Model\Activity::CATEGORY_ADDED_QUESTION;
        $activity->subject = $category;
        $activity->data = $question;

        $activity = (new \Mapper\Activity\CAddedQ('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(\Model\Activity::CATEGORY_ADDED_QUESTION, $activity->type);
    }
}
