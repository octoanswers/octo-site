<?php

class Trait_Model_Question_URL__get_history_URLTest extends PHPUnit\Framework\TestCase
{
    public function test__EN_history_URL()
    {
        $question = new Question_Model();
        $question->id = 12;

        $this->assertEquals('https://answeropedia.org/en/answer/12/history', $question->get_history_URL('en'));
    }

    public function test__RU_history_URL()
    {
        $question = new Question_Model();
        $question->id = 7;

        $this->assertEquals('https://answeropedia.org/ru/answer/7/history', $question->get_history_URL('ru'));
    }
}
