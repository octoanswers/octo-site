<?php

namespace Test\Query\Answers\answerWithID;

class EnTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Question_with_answer()
    {
        $answer = (new \Query\Answers('en'))->answerWithID(6);

        $this->assertEquals(6, $answer->id);
        $this->assertEquals('Yes, birds are mark his territory.', $answer->text);
    }
}
