<?php

class Question_URL_Trait__getURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $question = new Question_Model();
        $question->id = 19;
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals('https://answeropedia.org/en/How_iPhone_8_are_charged', $question->getURL('en'));
    }

    public function test_RuTitle()
    {
        $question = new Question_Model();
        $question->id = 18;
        $question->title = 'Нужны ли COOKIE?';

        $this->assertEquals('https://answeropedia.org/ru/%D0%9D%D1%83%D0%B6%D0%BD%D1%8B_%D0%BB%D0%B8_COOKIE', $question->getURL('ru'));
    }
}
