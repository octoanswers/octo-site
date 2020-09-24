<?php

namespace Test\Helper\URL\Page\getMainURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en', \Helper\URL\Page::getMainURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru', \Helper\URL\Page::getMainURL('ru'));
    }
}
