<?php

class Topics_Query__findNewest__en__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['topics']];

    public function test_withoutParams()
    {
        $topics = (new Topics_Query('en'))->findNewest();

        $this->assertEquals(10, count($topics));

        $this->assertEquals(17, $topics[0]->getID());
        $this->assertEquals('photosynthez', $topics[0]->getTitle());

        $this->assertEquals(8, $topics[9]->getID());
        $this->assertEquals('parfum', $topics[9]->getTitle());
    }
}
