<?php

class Mapper_Topic_update_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test_UpdateWithFullParams_Ok()
    {
        $topic = new Topic_Model();
        $topic->setID(2);
        $topic->setTitle('updatedtopic');

        $topic = (new Topic_Mapper('ru'))->update($topic);

        $this->assertEquals(2, $topic->getID());
        $this->assertEquals('updatedtopic', $topic->getTitle());
    }

    public function test_UpdateWithMinParams_Ok()
    {
        $topic = new Topic_Model();
        $topic->setID(4);
        $topic->setTitle('обновленнаятема');

        $topic = (new Topic_Mapper('ru'))->update($topic);

        $this->assertEquals(4, $topic->getID());
        $this->assertEquals('обновленнаятема', $topic->getTitle());
    }
}
