<?php

class Query_Question__question_with_title__negative__question_titleTest extends Abstract_DB_TestCase
{
    public function test__Question_title_is_empty()
    {
        $this->expectExceptionMessage('Question title param "" must have a length between 3 and 255');
        $question = (new Question_Query('en'))->question_with_title('');
    }

    public function test__Question_title_too_short()
    {
        $this->expectExceptionMessage('Question title param "F" must have a length between 3 and 255');
        $question = (new Question_Query('en'))->question_with_title('F');
    }
}
