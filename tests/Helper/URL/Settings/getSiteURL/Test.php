<?php

class Settings_URL_Helper__getSiteURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('http://octoanswers.com/en/settings/site', Settings_URL_Helper::getSiteURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('http://octoanswers.com/ru/settings/site', Settings_URL_Helper::getSiteURL('ru'));
    }
}
