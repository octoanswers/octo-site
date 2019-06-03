<?php

class Query_Search_searchHashtags_Query_Test extends Abstract_DB_TestCase
{
    public function test_QueryRequestIsEmpty_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "" must have a length between 1 and 32');
        $hashtags = (new Search_Query('ru'))->searchHashtags('');
    }

    public function test_QueryRequestBelow3_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "A" must have a length between 1 and 32');
        $hashtags = (new Search_Query('ru'))->searchHashtags('A');
    }

    public function test_QueryRequestGreaterThen64_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text" must have a length between 1 and 32');
        $hashtags = (new Search_Query('ru'))->searchHashtags('some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text');
    }
}
