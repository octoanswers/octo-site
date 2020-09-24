<?php

namespace Test\Traits\Model\Category\getURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__URL_for_simple_category()
    {
        $category = new \Model\Category();
        $category->title = 'footag';

        $this->assertEquals('https://answeropedia.org/en/category/footag', $category->getURL('en'));
    }

    public function test__URL_for_category_with_underscore()
    {
        $category = new \Model\Category();
        $category->title = 'my_day';

        $this->assertEquals('https://answeropedia.org/en/category/my__day', $category->getURL('en'));
    }

    public function test__URL_for_RU_category()
    {
        $category = new \Model\Category();
        $category->title = 'дождь';

        $this->assertEquals('https://answeropedia.org/ru/category/%D0%B4%D0%BE%D0%B6%D0%B4%D1%8C', $category->getURL('ru'));
    }
}
