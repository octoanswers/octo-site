<?php

class Query_Contributions__findAnswerContributors__questionID__Test extends Abstract_DB_TestCase
{
    public function testQuestionIDEqualZero()
    {
        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $actualResponse = (new Contributors_Query('ru'))->findAnswerContributors(0);
    }

    public function testQuestionIDIsNegative()
    {
        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $actualResponse = (new Contributors_Query('ru'))->findAnswerContributors(-1);
    }
}
