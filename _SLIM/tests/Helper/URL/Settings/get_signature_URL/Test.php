<?php

namespace Test\Helper\URL\Settings\getSignatureURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/settings#signature', \Helper\URL\Settings::getSignatureURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/settings#signature', \Helper\URL\Settings::getSignatureURL('ru'));
    }
}
