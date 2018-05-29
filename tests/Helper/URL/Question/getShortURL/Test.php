<?php

class Question_URL_Helper__getShortURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_FullParam_Ok()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->setTitle("What is 'Touch ID' in iPhone?");

        $this->assertEquals('http://octoanswers.com/en/q/13', Question_URL_Helper::getShortURL('en', $question));
    }

    public function test_MinParam_Ok()
    {
        $question = new Question_Model();
        $question->setID(13);

        $this->assertEquals('http://octoanswers.com/en/q/13', Question_URL_Helper::getShortURL('en', $question));
    }
}
