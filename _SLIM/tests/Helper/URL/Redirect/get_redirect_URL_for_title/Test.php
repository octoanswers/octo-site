<?php

namespace Test\Helper\URL\Redirect\getRedirectURLForTitle;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $url = \Helper\URL\Redirect::getRedirectURLForTitle('ru', 'This is question?');
        $this->assertEquals('https://answeropedia.org/ru/This_is_question', $url);
    }
}
