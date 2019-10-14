<?php

namespace Test\Helper\URL\Categories\get_newest_URL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = \Helper\URL\Categories::get_newest_URL('ru');
        $this->assertEquals('https://answeropedia.org/ru/categories/newest', $url);
    }

    public function test_ru_1()
    {
        $url = \Helper\URL\Categories::get_newest_URL('ru', 1);
        $this->assertEquals('https://answeropedia.org/ru/categories/newest', $url);
    }

    public function test_en_1()
    {
        $url = \Helper\URL\Categories::get_newest_URL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/categories/newest', $url);
    }

    public function test_13()
    {
        $url = \Helper\URL\Categories::get_newest_URL('en', 13);
        $this->assertEquals('https://answeropedia.org/en/categories/newest?page=13', $url);
    }
}
