<?php

class Query_Search_searchCategories_Query_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_QueryRequestIsEmpty_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "" must have a length between 1 and 32');
        $categories = (new Search_Query('ru'))->searchCategories('');
    }

    public function test_QueryRequestGreaterThen64_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text" must have a length between 1 and 32');
        $categories = (new Search_Query('ru'))->searchCategories('some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text');
    }
}
