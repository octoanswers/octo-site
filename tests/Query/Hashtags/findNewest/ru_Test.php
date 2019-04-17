<?php

class Hashtags_Query__findNewest_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_withoutParams()
    {
        $hashtags = (new Hashtags_Query('ru'))->findNewest();

        $this->assertEquals(10, count($hashtags));

        $this->assertEquals(17, $hashtags[0]->getID());
        $this->assertEquals('фотосинтез', $hashtags[0]->title);

        $this->assertEquals(8, $hashtags[9]->getID());
        $this->assertEquals('парфюмерия', $hashtags[9]->title);
    }

    public function test_firstPage()
    {
        $hashtags = (new Hashtags_Query('ru'))->findNewest(1);

        $this->assertEquals(10, count($hashtags));

        $this->assertEquals(17, $hashtags[0]->getID());
        $this->assertEquals('фотосинтез', $hashtags[0]->title);

        $this->assertEquals(8, $hashtags[9]->getID());
        $this->assertEquals('парфюмерия', $hashtags[9]->title);
    }

    public function test_secondPage()
    {
        $hashtags = (new Hashtags_Query('ru'))->findNewest(2);

        $this->assertEquals(10, count($hashtags));

        $this->assertEquals(10, $hashtags[0]->getID());
        $this->assertEquals('религия', $hashtags[0]->title);

        $this->assertEquals(1, $hashtags[9]->getID());
        $this->assertEquals('русскаялитература', $hashtags[9]->title);
    }

    public function test_FindFirst13Questions_Ok()
    {
        $hashtags = (new Hashtags_Query('ru'))->findNewest(1, 13);

        $this->assertEquals(13, count($hashtags));

        $this->assertEquals(17, $hashtags[0]->getID());
        $this->assertEquals('фотосинтез', $hashtags[0]->title);

        $this->assertEquals(5, $hashtags[12]->getID());
        $this->assertEquals('москва', $hashtags[12]->title);
    }
}
