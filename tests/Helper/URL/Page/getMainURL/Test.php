<?php

class Page_URL_Helper__getMainURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en', Page_URL_Helper::getMainURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru', Page_URL_Helper::getMainURL('ru'));
    }
}
