<?php

class Query_Category__find_with_title__ruTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__Category_exists()
    {
        $category = (new \Query\Category('ru'))->find_with_title('парфюмерия');

        $this->assertEquals(8, $category->id);
        $this->assertEquals('Парфюмерия', $category->title);
    }

    public function test__Category_not_exists()
    {
        $category = (new \Query\Category('ru'))->find_with_title('notexists');

        $this->assertEquals(null, $category);
    }
}
