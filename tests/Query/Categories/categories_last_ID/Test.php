<?php

namespace Test\Query\Categories\categories_last_ID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__Get_categories_last_ID()
    {
        $actualResponse = (new \Query\Categories('ru'))->categories_last_ID();
        $this->assertEquals(18, $actualResponse);
    }
}
