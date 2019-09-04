<?php

class Categories_Query__categories_last_ID_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_base()
    {
        $actualResponse = (new Categories_Query('ru'))->categories_last_ID();
        $this->assertEquals(18, $actualResponse);
    }
}
