<?php

class Mapper_Category__update__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_Update_category_with_EN_title()
    {
        $category = new Category_Model();
        $category->id = 7;
        $category->title = 'newcategory';

        $category = (new Category_Mapper('ru'))->update($category);

        $this->assertEquals(7, $category->id);
        $this->assertEquals('newcategory', $category->title);
    }

    public function test_Update_category_with_RU_title()
    {
        $category = new Category_Model();
        $category->id = 4;
        $category->title = 'новаятема';

        $category = (new Category_Mapper('ru'))->update($category);

        $this->assertEquals(4, $category->id);
        $this->assertEquals('новаятема', $category->title);
    }
}
