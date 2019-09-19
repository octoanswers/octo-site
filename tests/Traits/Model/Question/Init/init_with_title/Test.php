<?php

class Trait_Model_Question__init_with_titleTest extends PHPUnit\Framework\TestCase
{
    public function test__Full_params()
    {
        $question = \Model\Question::init_with_title('This is question?');

        $this->assertEquals('This is question?', $question->title);
        $this->assertEquals(null, $question->id);
        $this->assertEquals(false, $question->isRedirect);
    }

    public function test__RU_title()
    {
        $question = \Model\Question::init_with_title('Когда закончится дождь?');

        $this->assertEquals('Когда закончится дождь?', $question->title);
        $this->assertEquals(null, $question->id);
        $this->assertEquals(false, $question->isRedirect);
    }
}
