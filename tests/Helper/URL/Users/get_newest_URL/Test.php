<?php

class Users_URL_Helper__get_newest_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = \Helper\URL\Users::get_newest_URL('ru');
        $this->assertEquals('https://answeropedia.org/ru/users/newest', $url);
    }

    public function test_ru_1()
    {
        $url = \Helper\URL\Users::get_newest_URL('ru', 1);
        $this->assertEquals('https://answeropedia.org/ru/users/newest', $url);
    }

    public function test_en_1()
    {
        $url = \Helper\URL\Users::get_newest_URL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/users/newest', $url);
    }

    public function test_13()
    {
        $url = \Helper\URL\Users::get_newest_URL('en', 13);
        $this->assertEquals('https://answeropedia.org/en/users/newest?page=13', $url);
    }
}
