<?php

namespace Test\Traits\Model\Category\init_with_DB_state;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Init_category_with_DB_state()
    {
        $category = \Model\Category::initWithDBState([
            'c_id'            => 13,
            'c_title'         => 'virtual',
            'c_words'         => 'cpu',
            'cat_is_redirect' => 0,
        ]);

        $this->assertEquals(13, $category->id);
        $this->assertEquals('virtual', $category->title);
    }

    public function test__Init_category_with_DB_state_on_Russian()
    {
        $category = \Model\Category::initWithDBState([
            'c_id'            => 231,
            'c_title'         => 'Медицинские услуги',
            'c_words'         => 'таблетка',
            'cat_is_redirect' => 0,
        ]);

        $this->assertEquals(231, $category->id);
        $this->assertEquals('Медицинские услуги', $category->title);
    }

    public function test__Error_when_init_category_with_empty_state()
    {
        $this->expectExceptionMessage('Category init with empty state');
        $category = \Model\Category::initWithDBState([]);
    }
}
