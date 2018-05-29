<?php

class Query_Search_searchTopics_Query_Test extends Abstract_DB_TestCase
{
    public function test_QueryRequestIsEmpty_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "" must have a length between 2 and 32');
        $topics = (new Search_Query('ru'))->searchTopics('');
    }

    public function test_QueryRequestBelow3_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "A" must have a length between 2 and 32');
        $topics = (new Search_Query('ru'))->searchTopics('A');
    }

    public function test_QueryRequestGreaterThen64_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text" must have a length between 2 and 32');
        $topics = (new Search_Query('ru'))->searchTopics('some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text');
    }
}
