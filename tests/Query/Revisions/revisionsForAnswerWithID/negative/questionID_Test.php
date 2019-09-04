<?php

class Query_Revisions__revisions_for_answer_with_ID__negative__questionID__Test extends Abstract_DB_TestCase
{
    public function testQuestionIDEqualZero()
    {
        $questionID = 0;

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $actualResponse = (new Revisions_Query('ru'))->revisions_for_answer_with_ID($questionID);
    }

    public function testQuestionIDIsNegative()
    {
        $questionID = -1;

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $actualResponse = (new Revisions_Query('ru'))->revisions_for_answer_with_ID($questionID);
    }
}
