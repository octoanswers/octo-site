<?php

namespace Test\Traits\Model\Question\URL\getEditURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__EN_edit_URL()
    {
        $question = new \Model\Question();
        $question->id = 12;

        $this->assertEquals('https://answeropedia.org/en/answer/12/edit', $question->getEditURL('en'));
    }

    public function test__RU_edit_URL()
    {
        $question = new \Model\Question();
        $question->id = 7;

        $this->assertEquals('https://answeropedia.org/ru/answer/7/edit', $question->getEditURL('ru'));
    }
}
