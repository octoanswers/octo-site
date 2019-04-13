<?php

class Mapper_Activity_UFH__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['activities']];

    public function test_CreateWithFullParams_Ok()
    {
        $user = new User_Model;
        $user->setID(46);
        $user->setName('Steve Bo');

        $hashtag = Hashtag_Model::initWithTitle('tag10');

        $activity = new Activity_Model();
        $activity->setType(Activity_Model::F_U_FOLLOW_H);
        $activity->setSubject($user);
        $activity->setData($hashtag);

        $activity = (new UFollowH_Activity_Mapper('ru'))->create($activity);

        $this->assertEquals(13, $activity->getID());
        $this->assertEquals(Activity_Model::F_U_FOLLOW_H, $activity->getType());
    }
}
