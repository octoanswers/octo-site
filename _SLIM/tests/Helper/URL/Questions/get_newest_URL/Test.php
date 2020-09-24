<?php

namespace Test\Helper\URL\Questions\getNewestURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = \Helper\URL\Questions::getNewestURL('en');
        $this->assertEquals('https://answeropedia.org/en/questions/newest', $url);
    }

    public function test_1()
    {
        $url = \Helper\URL\Questions::getNewestURL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/questions/newest', $url);
    }

    public function test_13()
    {
        $url = \Helper\URL\Questions::getNewestURL('en', 13);
        $this->assertEquals('https://answeropedia.org/en/questions/newest?page=13', $url);
    }
}
