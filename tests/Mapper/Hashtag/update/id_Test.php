<?php

class Mapper_Hashtag_update_id_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test_UpdateWithNotExistsID_ThrowException()
    {
        $topic = new Topic_Model();
        $topic->setID(2215);
        $topic->setTitle('impossible');

        $this->expectExceptionMessage("Topic with ID 2215 not exists");
        $topic = (new Topic_Mapper('ru'))->update($topic);
    }

    public function test_UpdateWithIDEqualZero_ThrowException()
    {
        $topic = new Topic_Model();
        $topic->setID(0);
        $topic->setTitle('car');

        $this->expectExceptionMessage('Topic id param 0 must be greater than or equal to 1');
        $topic = (new Topic_Mapper('ru'))->update($topic);
    }

    public function test_UpdateWithIDBelowZero_ThrowException()
    {
        $topic = new Topic_Model();
        $topic->setID(-1);
        $topic->setTitle('guf');

        $this->expectExceptionMessage('Topic id param -1 must be greater than or equal to 1');
        $topic = (new Topic_Mapper('ru'))->update($topic);
    }
}
