<?php

namespace Test\Traits\Model\Question\URL\get_edit_URL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__EN_edit_URL()
    {
        $question = new \Model\Question();
        $question->id = 12;

        $this->assertEquals('https://answeropedia.org/en/answer/12/edit', $question->get_edit_URL('en'));
    }

    public function test__RU_edit_URL()
    {
        $question = new \Model\Question();
        $question->id = 7;

        $this->assertEquals('https://answeropedia.org/ru/answer/7/edit', $question->get_edit_URL('ru'));
    }
}
