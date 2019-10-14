<?php

namespace Test\Helper\URL\Settings\getNewestURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = \Helper\URL\Users::getNewestURL('ru');
        $this->assertEquals('https://answeropedia.org/ru/users/newest', $url);
    }

    public function test_ru_1()
    {
        $url = \Helper\URL\Users::getNewestURL('ru', 1);
        $this->assertEquals('https://answeropedia.org/ru/users/newest', $url);
    }

    public function test_en_1()
    {
        $url = \Helper\URL\Users::getNewestURL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/users/newest', $url);
    }

    public function test_13()
    {
        $url = \Helper\URL\Users::getNewestURL('en', 13);
        $this->assertEquals('https://answeropedia.org/en/users/newest?page=13', $url);
    }
}
