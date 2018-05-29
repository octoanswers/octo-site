<?php

class Answer_URL_Helper__getEditURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $question = new Question_Model();
        $question->setID(12);

        $this->assertEquals('http://octoanswers.com/en/answer/12/edit', Answer_URL_Helper::getEditURL('en', $question));
    }

    public function test_ru()
    {
        $question = new Question_Model();
        $question->setID(7);

        $this->assertEquals('http://octoanswers.com/ru/answer/7/edit', Answer_URL_Helper::getEditURL('ru', $question));
    }
}
