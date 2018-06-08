<?php

class Settings_URL_Helper__getAvatarURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('http://octoanswers.com/en/settings#avatar', Settings_URL_Helper::getAvatarURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('http://octoanswers.com/ru/settings#avatar', Settings_URL_Helper::getAvatarURL('ru'));
    }
}
