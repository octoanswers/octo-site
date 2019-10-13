<?php

class Query_Category__category_with_ID__ruTest extends \Tests\DB\TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__Correct_category_ID()
    {
        $category = (new \Query\Category('ru'))->category_with_ID(6);

        $this->assertEquals(6, $category->id);
        $this->assertEquals('Автоспорт', $category->title);
    }
}
