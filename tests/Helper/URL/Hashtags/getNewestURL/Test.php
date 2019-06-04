<?php

class Categories_URL_Helper__getNewestURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = Categories_URL_Helper::getNewestURL('ru');
        $this->assertEquals('https://answeropedia.org/ru/categories/newest', $url);
    }

    public function test_ru_1()
    {
        $url = Categories_URL_Helper::getNewestURL('ru', 1);
        $this->assertEquals('https://answeropedia.org/ru/categories/newest', $url);
    }

    public function test_en_1()
    {
        $url = Categories_URL_Helper::getNewestURL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/categories/newest', $url);
    }

    public function test_13()
    {
        $url = Categories_URL_Helper::getNewestURL('en', 13);
        $this->assertEquals('https://answeropedia.org/en/categories/newest?page=13', $url);
    }
}
