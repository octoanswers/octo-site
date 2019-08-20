<?php

class Question_URL_Trait__get_edit_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $question = new Question_Model();
        $question->id = 12;

        $this->assertEquals('https://answeropedia.org/en/answer/12/edit', $question->get_edit_URL('en'));
    }

    public function test_ru()
    {
        $question = new Question_Model();
        $question->id = 7;

        $this->assertEquals('https://answeropedia.org/ru/answer/7/edit', $question->get_edit_URL('ru'));
    }
}
