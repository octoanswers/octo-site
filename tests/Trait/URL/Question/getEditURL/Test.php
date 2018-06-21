<?php

class Question_URL_Trait__getEditURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $question = new Question_Model();
        $question->setID(12);

        $this->assertEquals('https://octoanswers.com/en/answer/12/edit', $question->getEditURL('en'));
    }

    public function test_ru()
    {
        $question = new Question_Model();
        $question->setID(7);

        $this->assertEquals('https://octoanswers.com/ru/answer/7/edit', $question->getEditURL('ru'));
    }
}
