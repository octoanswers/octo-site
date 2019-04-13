<?php

class Hashtags_URL_Helper__getNewestURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = Hashtags_URL_Helper::getNewestURL('ru');
        $this->assertEquals('https://answeropedia.org/ru/hashtags/newest', $url);
    }

    public function test_ru_1()
    {
        $url = Hashtags_URL_Helper::getNewestURL('ru', 1);
        $this->assertEquals('https://answeropedia.org/ru/hashtags/newest', $url);
    }

    public function test_en_1()
    {
        $url = Hashtags_URL_Helper::getNewestURL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/hashtags/newest', $url);
    }

    public function test_13()
    {
        $url = Hashtags_URL_Helper::getNewestURL('en', 13);
        $this->assertEquals('https://answeropedia.org/en/hashtags/newest?page=13', $url);
    }
}
