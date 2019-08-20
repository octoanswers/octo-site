<?php

class Mapper_Activity_UFC__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new User_Model();
        $user->id = 46;
        $user->name = 'Steve Bo';

        $category = Category::initWithTitle('tag10');

        $activity = new Activity_Model();
        $activity->type = Activity_Model::USER_FOLLOW_CATEGORY;
        $activity->subject = $user;
        $activity->data = $category;

        $activity = (new UFollowC_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->id);
        $this->assertEquals(Activity_Model::USER_FOLLOW_CATEGORY, $activity->type);
    }
}
