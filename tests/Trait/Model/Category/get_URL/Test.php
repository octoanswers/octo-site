<?php

class Trait_Model_Category_URL__get_URLTest extends PHPUnit\Framework\TestCase
{
    public function test__URL_for_simple_category()
    {
        $category = new Category_Model();
        $category->title = 'footag';

        $this->assertEquals('https://answeropedia.org/en/category/footag', $category->get_URL('en'));
    }

    public function test__URL_for_category_with_underscore()
    {
        $category = new Category_Model();
        $category->title = 'my_day';

        $this->assertEquals('https://answeropedia.org/en/category/my__day', $category->get_URL('en'));
    }

    public function test__URL_for_RU_category()
    {
        $category = new Category_Model();
        $category->title = 'дождь';

        $this->assertEquals('https://answeropedia.org/ru/category/%D0%B4%D0%BE%D0%B6%D0%B4%D1%8C', $category->get_URL('ru'));
    }
}
