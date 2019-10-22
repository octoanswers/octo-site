<?php

namespace Test\Query\Question\randomQuestion;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Random_question()
    {
        $question = (new \Query\Question('en'))->randomQuestion();

        $this->assertIsInt($question->id);
        $this->assertIsString($question->title);
    }
}
