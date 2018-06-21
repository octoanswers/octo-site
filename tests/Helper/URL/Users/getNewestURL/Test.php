<?php

class Users_URL_Helper__getNewestURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = Users_URL_Helper::getNewestURL('ru');
        $this->assertEquals('https://octoanswers.com/ru/users/newest', $url);
    }

    public function test_ru_1()
    {
        $url = Users_URL_Helper::getNewestURL('ru', 1);
        $this->assertEquals('https://octoanswers.com/ru/users/newest', $url);
    }

    public function test_en_1()
    {
        $url = Users_URL_Helper::getNewestURL('en', 1);
        $this->assertEquals('https://octoanswers.com/en/users/newest', $url);
    }

    public function test_13()
    {
        $url = Users_URL_Helper::getNewestURL('en', 13);
        $this->assertEquals('https://octoanswers.com/en/users/newest?page=13', $url);
    }
}
