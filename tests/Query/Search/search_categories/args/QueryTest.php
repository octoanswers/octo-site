<?php

namespace Test\Query\Search\searchCategories;

class QueryTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__Query_string_is_empty()
    {
        $this->expectExceptionMessage('Search query param "" must have a length between 1 and 32');
        $categories = (new \Query\Search('ru'))->searchCategories('');
    }

    public function test__Query_string_greater_then_64_chars()
    {
        $this->expectExceptionMessage('Search query param "some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text" must have a length between 1 and 32');
        $categories = (new \Query\Search('ru'))->searchCategories('some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text');
    }
}
