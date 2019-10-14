<?php

namespace Test\Query\Question\questionWithID;

class EnTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Question_with_answer()
    {
        $question = (new \Query\Question('en'))->questionWithID(6);

        $this->assertEquals(6, $question->id);
        $this->assertEquals('How birds are mark his territory?', $question->title);
        $this->assertEquals('4_2013_05_09_123', $question->imageBaseName);
    }
}
