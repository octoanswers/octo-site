<?php

class Mapper_Question_question_with_title_NegativeQuestionTitle_Test extends Abstract_DB_TestCase
{
    public function test_questionUriIsEmpty()
    {
        $this->expectExceptionMessage('Question title param "" must have a length between 3 and 255');
        $question = (new Question_Query('en'))->question_with_title('');
    }

    public function test_questionUriTooShort()
    {
        $this->expectExceptionMessage('Question title param "F" must have a length between 3 and 255');
        $question = (new Question_Query('en'))->question_with_title('F');
    }
}
