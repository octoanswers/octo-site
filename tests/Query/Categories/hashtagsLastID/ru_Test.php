<?php

class Categories_Query__categoriesLastID_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_base()
    {
        $actualResponse = (new Categories_Query('ru'))->categoriesLastID();
        $this->assertEquals(18, $actualResponse);
    }
}
