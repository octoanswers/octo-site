<?php

class Page_URL_Helper__getMainURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('http://octoanswers.com/en', Page_URL_Helper::getMainURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('http://octoanswers.com/ru', Page_URL_Helper::getMainURL('ru'));
    }
}
