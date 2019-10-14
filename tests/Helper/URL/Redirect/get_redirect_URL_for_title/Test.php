<?php

namespace Test\Helper\URL\Redirect\get_redirect_URL_for_title;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $url = \Helper\URL\Redirect::get_redirect_URL_for_title('ru', 'This is question?');
        $this->assertEquals('https://answeropedia.org/ru/This_is_question', $url);
    }
}
