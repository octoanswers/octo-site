<?php

class Settings_URL_Helper__get_site_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/settings#site', \Helper\URL\Settings::get_site_URL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/settings#site', \Helper\URL\Settings::get_site_URL('ru'));
    }
}
