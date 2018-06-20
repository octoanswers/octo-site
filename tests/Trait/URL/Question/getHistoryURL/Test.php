<?php

class Question_URL_Trait__getHistoryURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $question = new Question_Model();
        $question->setID(12);

        $this->assertEquals('http://octoanswers.com/en/answer/12/history', $question->getHistoryURL('en'));
    }

    public function test_ru()
    {
        $question = new Question_Model();
        $question->setID(7);

        $this->assertEquals('http://octoanswers.com/ru/answer/7/history', $question->getHistoryURL('ru'));
    }
}