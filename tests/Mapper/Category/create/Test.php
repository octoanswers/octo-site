<?php

namespace Test\Mapper\Category\create;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['categories']];

    public function test_Create_category_with_one_word_name()
    {
        $category = new \Model\Category();
        $category->title = 'New';

        $category = (new \Mapper\Category('ru'))->create($category);

        $this->assertEquals(19, $category->id);
        $this->assertEquals('New', $category->title);
    }

    public function test_Create_category_with_two_word_name()
    {
        $category = new \Model\Category();
        $category->title = 'Foo Bar';

        $category = (new \Mapper\Category('ru'))->create($category);

        $this->assertEquals(19, $category->id);
        $this->assertEquals('Foo Bar', $category->title);
    }

    public function test_Create_category_with_RU_title()
    {
        $category = new \Model\Category();
        $category->title = 'тема';

        $category = (new \Mapper\Category('ru'))->create($category);

        $this->assertEquals(19, $category->id);
        $this->assertEquals('тема', $category->title);
    }
}
