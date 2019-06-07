<?php

class Trait_URL_Category_getURLTest extends PHPUnit\Framework\TestCase
{
    public function test_URL_for_simple_category()
    {
        $category = new Category;
        $category->title = 'footag';

        $this->assertEquals('https://answeropedia.org/en/category/footag', $category->getURL('en'));
    }

    public function test_URL_for_category_with_underscore()
    {
        $category = new Category;
        $category->title = 'my_day';

        $this->assertEquals('https://answeropedia.org/en/category/my__day', $category->getURL('en'));
    }

    public function test_URL_for_RU_category()
    {
        $category = new Category;
        $category->title = 'дождь';

        $this->assertEquals('https://answeropedia.org/ru/category/%D0%B4%D0%BE%D0%B6%D0%B4%D1%8C', $category->getURL('ru'));
    }
}
