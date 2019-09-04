<?php

class Settings_URL_Helper__get_signature_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/settings#signature', Settings_URL_Helper::get_signature_URL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/settings#signature', Settings_URL_Helper::get_signature_URL('ru'));
    }
}
