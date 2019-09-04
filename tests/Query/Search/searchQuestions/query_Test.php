<?php

class Query_Search_search_questions_query_Test extends Abstract_DB_TestCase
{
    public function testQueryRequestIsEmpty()
    {
        $this->expectExceptionMessage('Search query param "" must have a length between 2 and 32');
        $questions = (new Search_Query('ru'))->search_questions('');
    }

    public function testQueryRequestBelow3()
    {
        $this->expectExceptionMessage('Search query param "A" must have a length between 2 and 32');
        $questions = (new Search_Query('ru'))->search_questions('A');
    }

    public function testQueryRequestGreaterThen64()
    {
        $this->expectExceptionMessage('Search query param "some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text" must have a length between 2 and 32');
        $questions = (new Search_Query('ru'))->search_questions('some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text');
    }
}
