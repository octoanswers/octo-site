<?php

namespace Test\Helper\URL\Sandbox\get_all_URL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = \Helper\URL\Sandbox::get_all_URL('ru');
        $this->assertEquals('https://answeropedia.org/ru/sandbox/all', $url);
    }

    public function test_ru_1()
    {
        $url = \Helper\URL\Sandbox::get_all_URL('ru', 1);
        $this->assertEquals('https://answeropedia.org/ru/sandbox/all', $url);
    }

    public function test_en_1()
    {
        $url = \Helper\URL\Sandbox::get_all_URL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/sandbox/all', $url);
    }

    public function test_13()
    {
        $url = \Helper\URL\Sandbox::get_all_URL('en', 13);
        $this->assertEquals('https://answeropedia.org/en/sandbox/all?page=13', $url);
    }
}
