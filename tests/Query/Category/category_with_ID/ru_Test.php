<?php

class Category_Query__category_with_ID__ruTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__Correct_category_ID()
    {
        $category = (new Category_Query('ru'))->category_with_ID(6);

        $this->assertEquals(6, $category->id);
        $this->assertEquals('Автоспорт', $category->title);
    }
}
