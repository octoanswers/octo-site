<?php

class Settings_URL_Helper__getSiteURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://octoanswers.com/en/settings#site', Settings_URL_Helper::getSiteURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://octoanswers.com/ru/settings#site', Settings_URL_Helper::getSiteURL('ru'));
    }
}
