<?php

class Mapper_Topic_create_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test_CreateWithEnTitle_Ok()
    {
        $topic = new Topic_Model();
        $topic->setTitle('newtopic');

        $topic = (new Topic_Mapper('ru'))->create($topic);

        $this->assertEquals(18, $topic->getID());
        $this->assertEquals('newtopic', $topic->getTitle());
    }

    public function test_CreateWithRuTitle_Ok()
    {
        $topic = new Topic_Model();
        $topic->setTitle('новаятема');

        $topic = (new Topic_Mapper('ru'))->create($topic);

        $this->assertEquals(18, $topic->getID());
        $this->assertEquals('новаятема', $topic->getTitle());
    }
}
