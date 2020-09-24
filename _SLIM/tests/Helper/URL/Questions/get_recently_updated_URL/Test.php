<?php

namespace Test\Helper\URL\Questions\getRecentlyUpdatedURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = \Helper\URL\Questions::getRecentlyUpdatedURL('en');
        $this->assertEquals('https://answeropedia.org/en/questions/recently-updated', $url);
    }

    public function test_1()
    {
        $url = \Helper\URL\Questions::getRecentlyUpdatedURL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/questions/recently-updated', $url);
    }

    public function test_13()
    {
        $url = \Helper\URL\Questions::getRecentlyUpdatedURL('en', 2);
        $this->assertEquals('https://answeropedia.org/en/questions/recently-updated?page=2', $url);
    }
}
