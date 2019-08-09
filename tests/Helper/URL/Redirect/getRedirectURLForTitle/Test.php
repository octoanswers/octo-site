<?php

class Redirect_URL_Helper__get_redirect_URL_for_title__Test extends PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $url = Redirect_URL_Helper::get_redirect_URL_for_title('ru', 'This is question?');
        $this->assertEquals('https://answeropedia.org/ru/This_is_question', $url);
    }
}
