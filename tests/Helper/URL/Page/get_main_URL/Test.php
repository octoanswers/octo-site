<?php

namespace Test\Helper\URL\Page\get_main_URL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en', \Helper\URL\Page::get_main_URL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru', \Helper\URL\Page::get_main_URL('ru'));
    }
}
