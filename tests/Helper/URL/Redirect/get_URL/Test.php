<?php

namespace Test\Helper\URL\Redirect\getURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $redirect = \Model\Redirect\Question::initWithDBState([
            'rd_from'  => 13,
            'rd_title' => 'This is question?',
        ]);

        $this->assertEquals('https://answeropedia.org/ru/This_is_question', \Helper\URL\Redirect::getURL('ru', $redirect));
    }
}
