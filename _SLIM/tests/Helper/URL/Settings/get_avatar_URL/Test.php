<?php

namespace Test\Helper\URL\Settings\getAvatarURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/settings#avatar', \Helper\URL\Settings::getAvatarURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/settings#avatar', \Helper\URL\Settings::getAvatarURL('ru'));
    }
}
