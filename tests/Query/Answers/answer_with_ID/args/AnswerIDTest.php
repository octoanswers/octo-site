<?php

namespace Test\Query\Answers\answer_with_ID;

class AnswerIDTest extends \Test\TestCase\DB
{
    public function test__Answer_ID_equal_zero()
    {
        $this->expectExceptionMessage('Answer id param 0 must be greater than or equal to 1');
        $question = (new \Query\Answers('ru'))->answer_with_ID(0);
    }

    public function test__Negative_answer_ID()
    {
        $this->expectExceptionMessage('Answer id param -1 must be greater than or equal to 1');
        $question = (new \Query\Answers('ru'))->answer_with_ID(-1);
    }
}
