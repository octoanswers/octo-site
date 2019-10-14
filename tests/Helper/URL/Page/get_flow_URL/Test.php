<?php

namespace Test\Helper\URL\Page\getFlowURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/flow', \Helper\URL\Page::getFlowURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/flow', \Helper\URL\Page::getFlowURL('ru'));
    }
}
