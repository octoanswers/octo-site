<?php

namespace Test\Query\Question\questionWithTitle;

class QuestionTitleTest extends \Test\TestCase\DB
{
    public function test__Question_title_is_empty()
    {
        $this->expectExceptionMessage('Question title param "" must have a length between 3 and 255');
        $question = (new \Query\Question('en'))->questionWithTitle('');
    }

    public function test__Question_title_too_short()
    {
        $this->expectExceptionMessage('Question title param "F" must have a length between 3 and 255');
        $question = (new \Query\Question('en'))->questionWithTitle('F');
    }
}
