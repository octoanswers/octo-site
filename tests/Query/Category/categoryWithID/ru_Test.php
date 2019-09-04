<?php

class Category_Query__category_with_ID__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_CorrectCategoryID_ReturnCategoryObj()
    {
        $category = (new Category_Query('ru'))->category_with_ID(6);

        $this->assertEquals(6, $category->id);
        $this->assertEquals('Автоспорт', $category->title);
    }
}
