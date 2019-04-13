<?php

class Hashtag_Query__findWithTitle__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test__HastagExists()
    {
        $topic = (new Topic_Query('ru'))->findWithTitle('парфюмерия');

        $this->assertEquals(8, $topic->getID());
        $this->assertEquals('парфюмерия', $topic->getTitle());
    }

    public function test__TopicNotExists()
    {
        $topic = (new Topic_Query('ru'))->findWithTitle('notexists');

        $this->assertEquals(null, $topic);
    }
}
