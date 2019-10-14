<?php

namespace Test\Traits\Model\Question\URL\getHistoryURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__EN_history_URL()
    {
        $question = new \Model\Question();
        $question->id = 12;

        $this->assertEquals('https://answeropedia.org/en/answer/12/history', $question->getHistoryURL('en'));
    }

    public function test__RU_history_URL()
    {
        $question = new \Model\Question();
        $question->id = 7;

        $this->assertEquals('https://answeropedia.org/ru/answer/7/history', $question->getHistoryURL('ru'));
    }
}
