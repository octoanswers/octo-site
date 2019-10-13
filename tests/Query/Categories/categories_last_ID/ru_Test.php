<?php

class Categories_Query__categories_last_ID__ruTest extends \Tests\DB\TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__Get_categories_last_ID()
    {
        $actualResponse = (new \Query\Categories('ru'))->categories_last_ID();
        $this->assertEquals(18, $actualResponse);
    }
}
