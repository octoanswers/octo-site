<?php

namespace Test\Helper\URL\Settings\get_signature_URL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/settings#signature', \Helper\URL\Settings::get_signature_URL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/settings#signature', \Helper\URL\Settings::get_signature_URL('ru'));
    }
}
