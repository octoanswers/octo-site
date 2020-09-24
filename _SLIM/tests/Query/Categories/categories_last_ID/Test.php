<?php

namespace Test\Query\Categories\categoriesLastID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__Get_categoriesLastID()
    {
        $actualResponse = (new \Query\Categories('ru'))->categoriesLastID();
        $this->assertEquals(18, $actualResponse);
    }
}
