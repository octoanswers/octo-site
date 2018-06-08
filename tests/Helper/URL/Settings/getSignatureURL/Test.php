<?php

class Settings_URL_Helper__getSignatureURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('http://octoanswers.com/en/settings#signature', Settings_URL_Helper::getSignatureURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('http://octoanswers.com/ru/settings#signature', Settings_URL_Helper::getSignatureURL('ru'));
    }
}
