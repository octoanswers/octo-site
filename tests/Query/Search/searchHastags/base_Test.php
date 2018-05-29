<?php

class Query_Search_searchTopics_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics']];

    public function test_SearchWithTwoResults_Ok()
    {
        $topics = (new Search_Query('ru'))->searchTopics('фото');

        $this->assertEquals(2, count($topics));

        $this->assertEquals(16, $topics[0]->getID());
        $this->assertEquals('Фотография', $topics[0]->getTitle());

        $this->assertEquals(17, $topics[1]->getID());
        $this->assertEquals('Фотосинтез', $topics[1]->getTitle());
    }
}
