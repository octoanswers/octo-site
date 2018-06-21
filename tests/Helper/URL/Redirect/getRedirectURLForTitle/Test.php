<?php

class Redirect_URL_Helper__getRedirectURLForTitle__Test extends PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $url = Redirect_URL_Helper::getRedirectURLForTitle('ru', 'This is question?');
        $this->assertEquals('https://octoanswers.com/ru/This_is_question', $url);
    }
}
