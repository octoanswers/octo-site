<?php

namespace Test\Helper\URL\Redirect\get_URL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $redirect = \Model\Redirect\Question::init_with_DB_state([
            'rd_from'  => 13,
            'rd_title' => 'This is question?',
        ]);

        $this->assertEquals('https://answeropedia.org/ru/This_is_question', \Helper\URL\Redirect::get_URL('ru', $redirect));
    }
}
