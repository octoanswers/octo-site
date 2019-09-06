<?php

class Settings_URL_Helper__get_avatar_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/settings#avatar', Settings_URL_Helper::get_avatar_URL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/settings#avatar', Settings_URL_Helper::get_avatar_URL('ru'));
    }
}
