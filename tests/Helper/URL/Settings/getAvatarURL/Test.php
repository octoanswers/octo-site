<?php

class Settings_URL_Helper__getAvatarURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://octoanswers.com/en/settings#avatar', Settings_URL_Helper::getAvatarURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://octoanswers.com/ru/settings#avatar', Settings_URL_Helper::getAvatarURL('ru'));
    }
}
