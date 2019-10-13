<?php

class Query_Question__question_with_ID__negative__question_IDTest extends \Test\TestCase\DB
{
    public function test__Question_ID_equal_zero()
    {
        $questionID = 0;

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $question = (new \Query\Question('ru'))->question_with_ID($questionID);
    }

    public function test__Negative_question_ID()
    {
        $questionID = -1;

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $question = (new \Query\Question('ru'))->question_with_ID($questionID);
    }
}
