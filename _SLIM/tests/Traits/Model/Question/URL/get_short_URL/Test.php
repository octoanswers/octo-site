<?php

namespace Test\Traits\Model\Question\URL\getShortURL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Full_params_short_URL()
    {
        $question = new \Model\Question();
        $question->id = 13;
        $question->title = "What is 'Touch ID' in iPhone?";

        $this->assertEquals('https://answeropedia.org/en/question/13', $question->getShortURL('en'));
    }

    public function test__Min_param_short_URL()
    {
        $question = new \Model\Question();
        $question->id = 13;

        $this->assertEquals('https://answeropedia.org/en/question/13', $question->getShortURL('en'));
    }
}
