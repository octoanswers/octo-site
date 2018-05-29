<?php

class Topics_Query__findNewest_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test_withoutParams()
    {
        $topics = (new Topics_Query('ru'))->findNewest();

        $this->assertEquals(10, count($topics));

        $this->assertEquals(17, $topics[0]->getID());
        $this->assertEquals('Фотосинтез', $topics[0]->getTitle());

        $this->assertEquals(8, $topics[9]->getID());
        $this->assertEquals('Парфюмерия', $topics[9]->getTitle());
    }

    public function test_firstPage()
    {
        $topics = (new Topics_Query('ru'))->findNewest(1);

        $this->assertEquals(10, count($topics));

        $this->assertEquals(17, $topics[0]->getID());
        $this->assertEquals('Фотосинтез', $topics[0]->getTitle());

        $this->assertEquals(8, $topics[9]->getID());
        $this->assertEquals('Парфюмерия', $topics[9]->getTitle());
    }

    public function test_secondPage()
    {
        $topics = (new Topics_Query('ru'))->findNewest(2);

        $this->assertEquals(10, count($topics));

        $this->assertEquals(10, $topics[0]->getID());
        $this->assertEquals('Религия', $topics[0]->getTitle());

        $this->assertEquals(1, $topics[9]->getID());
        $this->assertEquals('Русская литература', $topics[9]->getTitle());
    }

    public function test_FindFirst13Questions_Ok()
    {
        $topics = (new Topics_Query('ru'))->findNewest(1, 13);

        $this->assertEquals(13, count($topics));

        $this->assertEquals(17, $topics[0]->getID());
        $this->assertEquals('Фотосинтез', $topics[0]->getTitle());

        $this->assertEquals(5, $topics[12]->getID());
        $this->assertEquals('Москва', $topics[12]->getTitle());
    }
}
