<?php

namespace Test\Query\Category\categoryWithID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__Correct_category_ID()
    {
        $category = (new \Query\Category('ru'))->categoryWithID(6);

        $this->assertEquals(6, $category->id);
        $this->assertEquals('Автоспорт', $category->title);
    }
}
