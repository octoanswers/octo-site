<?php

namespace Test\Traits\Model\Question\Init\init_with_title;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__Full_params()
    {
        $question = \Model\Question::initWithTitle('This is question?');

        $this->assertEquals('This is question?', $question->title);
        $this->assertEquals(null, $question->id);
        $this->assertEquals(false, $question->isRedirect);
    }

    public function test__RU_title()
    {
        $question = \Model\Question::initWithTitle('Когда закончится дождь?');

        $this->assertEquals('Когда закончится дождь?', $question->title);
        $this->assertEquals(null, $question->id);
        $this->assertEquals(false, $question->isRedirect);
    }
}
