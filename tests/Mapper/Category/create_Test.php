<?php

class Mapper_Category_createTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_Create_category_with_one_word_name()
    {
        $category = new Category();
        $category->title = 'New';

        $category = (new Category_Mapper('ru'))->create($category);

        $this->assertEquals(18, $category->id);
        $this->assertEquals('New', $category->title);
    }

    public function test_Create_category_with_two_word_name()
    {
        $category = new Category();
        $category->title = 'Foo Bar';

        $category = (new Category_Mapper('ru'))->create($category);

        $this->assertEquals(18, $category->id);
        $this->assertEquals('Foo Bar', $category->title);
    }

    public function test_Create_category_with_RU_title()
    {
        $category = new Category();
        $category->title = 'тема';

        $category = (new Category_Mapper('ru'))->create($category);

        $this->assertEquals(18, $category->id);
        $this->assertEquals('тема', $category->title);
    }
}
