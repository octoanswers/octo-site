<?php

namespace Test\Helper\URL\Settings\get_avatar_URL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/settings#avatar', \Helper\URL\Settings::get_avatar_URL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/settings#avatar', \Helper\URL\Settings::get_avatar_URL('ru'));
    }
}
