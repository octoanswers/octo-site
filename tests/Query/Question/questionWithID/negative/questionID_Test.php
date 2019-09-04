<?php

class Question_Mapper_question_with_ID_NegativeQuestionID_Test extends Abstract_DB_TestCase
{
    public function testQuestionIDEqualZero()
    {
        $questionID = 0;

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $question = (new Question_Query('ru'))->question_with_ID($questionID);
    }

    public function testQuestionIDNegative()
    {
        $questionID = -1;

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $question = (new Question_Query('ru'))->question_with_ID($questionID);
    }
}
