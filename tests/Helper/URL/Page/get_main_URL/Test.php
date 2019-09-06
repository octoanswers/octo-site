<?php

class Page_URL_Helper__get_main_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en', Page_URL_Helper::get_main_URL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru', Page_URL_Helper::get_main_URL('ru'));
    }
}
