<?php

namespace Test\Helper\URL\Settings\getSiteURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/settings#site', \Helper\URL\Settings::getSiteURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/settings#site', \Helper\URL\Settings::getSiteURL('ru'));
    }
}
