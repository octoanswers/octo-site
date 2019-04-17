<?php

class Query_Search_searchHashtags_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags']];

    public function test_SearchWithTwoResults_Ok()
    {
        $hashtags = (new Search_Query('ru'))->searchHashtags('фото');

        $this->assertEquals(2, count($hashtags));

        $this->assertEquals(16, $hashtags[0]->getID());
        $this->assertEquals('фотография', $hashtags[0]->title);

        $this->assertEquals(17, $hashtags[1]->getID());
        $this->assertEquals('фотосинтез', $hashtags[1]->title);
    }
}
