<?php

class Topic_Query__topicWithID__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test_CorrectTopicID_ReturnTopicObj()
    {
        $topic = (new Topic_Query('ru'))->topicWithID(6);

        $this->assertEquals(6, $topic->getID());
        $this->assertEquals('автоспорт', $topic->getTitle());
    }
}
