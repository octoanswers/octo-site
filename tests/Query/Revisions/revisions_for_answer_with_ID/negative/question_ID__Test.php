<?php

class Query_Revisions__revisions_for_answer_with_ID__negative__question_IDTest extends \Test\TestCase\DB
{
    public function test__Question_ID_equal_zero()
    {
        $questionID = 0;

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $actualResponse = (new \Query\Revisions('ru'))->revisions_for_answer_with_ID($questionID);
    }

    public function test__Question_ID_is_negative()
    {
        $questionID = -1;

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $actualResponse = (new \Query\Revisions('ru'))->revisions_for_answer_with_ID($questionID);
    }
}
