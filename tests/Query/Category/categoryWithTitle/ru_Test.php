<?php

class Category_Query__findWithTitle__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test__HastagExists()
    {
        $category = (new Category_Query('ru'))->findWithTitle('парфюмерия');

        $this->assertEquals(8, $category->id);
        $this->assertEquals('Парфюмерия', $category->title);
    }

    public function test__CategoryNotExists()
    {
        $category = (new Category_Query('ru'))->findWithTitle('notexists');

        $this->assertEquals(null, $category);
    }
}
