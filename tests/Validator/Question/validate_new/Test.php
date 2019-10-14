<?php

namespace Test\Validator\Question\validate_new;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__New_question_with_full_params()
    {
        $question = new \Model\Question();
        $question->title = 'How iPhone 8 are charged?';
        $question->isRedirect = true;

        $this->assertEquals(true, \Validator\Question::validate_new($question));
    }

    public function test__New_question_with_min_params()
    {
        $question = new \Model\Question();
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals(true, \Validator\Question::validate_new($question));
    }
}
