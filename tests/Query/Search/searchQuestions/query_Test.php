<?php

class Query_Search_searchQuestions_query_Test extends Abstract_DB_TestCase
{
    public function testQueryRequestIsEmpty()
    {
        $this->expectExceptionMessage('Search query param "" must have a length between 2 and 32');
        $questions = (new Search_Query('ru'))->searchQuestions('');
    }

    public function testQueryRequestBelow3()
    {
        $this->expectExceptionMessage('Search query param "A" must have a length between 2 and 32');
        $questions = (new Search_Query('ru'))->searchQuestions('A');
    }

    public function testQueryRequestGreaterThen64()
    {
        $this->expectExceptionMessage('Search query param "some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text" must have a length between 2 and 32');
        $questions = (new Search_Query('ru'))->searchQuestions('some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text');
    }
}
