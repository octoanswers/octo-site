<?php

class Trait_Model_Question_URL__get_edit_URLTest extends PHPUnit\Framework\TestCase
{
    public function test__EN_edit_URL()
    {
        $question = new Question_Model();
        $question->id = 12;

        $this->assertEquals('https://answeropedia.org/en/answer/12/edit', $question->get_edit_URL('en'));
    }

    public function test__RU_edit_URL()
    {
        $question = new Question_Model();
        $question->id = 7;

        $this->assertEquals('https://answeropedia.org/ru/answer/7/edit', $question->get_edit_URL('ru'));
    }
}
