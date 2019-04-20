<?php

class Question_URL_Trait__getHistoryURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $question = new Question_Model();
        $question->id = 12;

        $this->assertEquals('https://answeropedia.org/en/answer/12/history', $question->getHistoryURL('en'));
    }

    public function test_ru()
    {
        $question = new Question_Model();
        $question->id = 7;

        $this->assertEquals('https://answeropedia.org/ru/answer/7/history', $question->getHistoryURL('ru'));
    }
}
