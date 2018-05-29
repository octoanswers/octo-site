<?php

class Query_Search_searchUsers_query_Test extends Abstract_DB_TestCase
{
    public function test_QueryRequestIsEmpty_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "" must have a length between 2 and 32');
        $users = (new Search_Query('users'))->searchUsers('');
    }

    public function test_QueryRequestBelow3_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "A" must have a length between 2 and 32');
        $users = (new Search_Query('users'))->searchUsers('A');
    }

    public function test_QueryRequestGreaterThen64_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text" must have a length between 2 and 32');
        $users = (new Search_Query('users'))->searchUsers('some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text');
    }
}
