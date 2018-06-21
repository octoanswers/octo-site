<?php

class Topics_URL_Helper__getNewestURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = Topics_URL_Helper::getNewestURL('ru');
        $this->assertEquals('https://octoanswers.com/ru/topics/newest', $url);
    }

    public function test_ru_1()
    {
        $url = Topics_URL_Helper::getNewestURL('ru', 1);
        $this->assertEquals('https://octoanswers.com/ru/topics/newest', $url);
    }

    public function test_en_1()
    {
        $url = Topics_URL_Helper::getNewestURL('en', 1);
        $this->assertEquals('https://octoanswers.com/en/topics/newest', $url);
    }

    public function test_13()
    {
        $url = Topics_URL_Helper::getNewestURL('en', 13);
        $this->assertEquals('https://octoanswers.com/en/topics/newest?page=13', $url);
    }
}
