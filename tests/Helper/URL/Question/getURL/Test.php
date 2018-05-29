<?php

class Question_URL_Helper__getURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $question = new Question_Model();
        $question->setTitle('How iPhone 8 are charged?');

        $this->assertEquals('http://octoanswers.com/en/How_iPhone_8_are_charged', Question_URL_Helper::getURL('en', $question));
    }

    public function test_RuTitle()
    {
        $question = new Question_Model();
        $question->setTitle('Можно ли сохранить массив в COOKIE?');

        $this->assertEquals('http://octoanswers.com/ru/Можно_ли_сохранить_массив_в_COOKIE', Question_URL_Helper::getURL('ru', $question));
    }
}
