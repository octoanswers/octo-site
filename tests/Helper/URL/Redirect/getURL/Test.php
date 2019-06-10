<?php

class Redirect_URL_Helper__getURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $redirect = Question_Redirect_Model::initWithDBState([
            'rd_from' => 13,
            'rd_title' => 'This is question?',
        ]);

        $this->assertEquals('https://answeropedia.org/ru/This_is_question', Redirect_URL_Helper::getURL('ru', $redirect));
    }
}
