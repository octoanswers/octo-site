<?php

class Question_URL_Trait__getShortURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_FullParam_Ok()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->setTitle("What is 'Touch ID' in iPhone?");

        $this->assertEquals('http://octoanswers.com/en/13', $question->getShortURL('en'));
    }

    public function test_MinParam_Ok()
    {
        $question = new Question_Model();
        $question->setID(13);

        $this->assertEquals('http://octoanswers.com/en/13', $question->getShortURL('en'));
    }
}
