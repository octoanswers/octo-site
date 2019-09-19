<?php

class Redirect_URL_Helper__get_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $redirect = \Model\Redirect\Question::init_with_DB_state([
            'rd_from'  => 13,
            'rd_title' => 'This is question?',
        ]);

        $this->assertEquals('https://answeropedia.org/ru/This_is_question', Redirect_URL_Helper::get_URL('ru', $redirect));
    }
}
