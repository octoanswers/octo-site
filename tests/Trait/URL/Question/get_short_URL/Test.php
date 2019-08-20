<?php

class Question_URL_Trait__get_short_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test_FullParam_Ok()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->title = "What is 'Touch ID' in iPhone?";

        $this->assertEquals('https://answeropedia.org/en/13', $question->get_short_URL('en'));
    }

    public function test_MinParam_Ok()
    {
        $question = new Question_Model();
        $question->id = 13;

        $this->assertEquals('https://answeropedia.org/en/13', $question->get_short_URL('en'));
    }
}
