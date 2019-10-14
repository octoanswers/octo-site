<?php

namespace Test\Helper\URL\Page\get_flow_URL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/flow', \Helper\URL\Page::get_flow_URL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/flow', \Helper\URL\Page::get_flow_URL('ru'));
    }
}
