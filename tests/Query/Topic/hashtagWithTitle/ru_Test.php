<?php

class Topic_Query__findWithTitle__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test__HastagExists()
    {
        $topic = (new Topic_Query('ru'))->findWithTitle('Парфюмерия');

        $this->assertEquals(8, $topic->getID());
        $this->assertEquals('Парфюмерия', $topic->getTitle());
    }

    public function test__TopicNotExists()
    {
        $topic = (new Topic_Query('ru'))->findWithTitle('notexists');

        $this->assertEquals(null, $topic);
    }
}
