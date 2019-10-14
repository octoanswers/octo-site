<?php

namespace Test\Traits\Model\Question\URL\get_URL;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Base_URL()
    {
        $question = new \Model\Question();
        $question->id = 19;
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals('https://answeropedia.org/en/How_iPhone_8_are_charged', $question->get_URL('en'));
    }

    public function test__Base_RU_URL()
    {
        $question = new \Model\Question();
        $question->id = 18;
        $question->title = 'Нужны ли COOKIE?';

        $this->assertEquals('https://answeropedia.org/ru/%D0%9D%D1%83%D0%B6%D0%BD%D1%8B_%D0%BB%D0%B8_COOKIE', $question->get_URL('ru'));
    }
}
