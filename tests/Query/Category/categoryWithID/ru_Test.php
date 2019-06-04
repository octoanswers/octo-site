<?php

class Category_Query__categoryWithID__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_CorrectCategoryID_ReturnCategoryObj()
    {
        $category = (new Category_Query('ru'))->categoryWithID(6);

        $this->assertEquals(6, $category->id);
        $this->assertEquals('Автоспорт', $category->title);
    }
}
