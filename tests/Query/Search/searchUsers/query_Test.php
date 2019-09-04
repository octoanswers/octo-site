<?php

class Query_Search_search_users_query_Test extends Abstract_DB_TestCase
{
    public function test_QueryRequestIsEmpty_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "" must have a length between 2 and 32');
        $users = (new Search_Query('users'))->search_users('');
    }

    public function test_QueryRequestBelow3_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "A" must have a length between 2 and 32');
        $users = (new Search_Query('users'))->search_users('A');
    }

    public function test_QueryRequestGreaterThen64_ThrowsException()
    {
        $this->expectExceptionMessage('Search query param "some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text" must have a length between 2 and 32');
        $users = (new Search_Query('users'))->search_users('some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text');
    }
}
