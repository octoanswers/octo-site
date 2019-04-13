<?php

use PHPUnit\Framework\TestCase;

class Query_ER_HashtagsQuestions__findByHashtagTitleAndQuestionID__question_id__Test extends TestCase
{
    public function test__QuestionIDEqualZero__ThrowException()
    {
        $this->expectExceptionMessage('HashtagToQuestion relation "questionID" property 0 must be greater than or equal to 1');
        $ERs = (new HashtagsToQuestions_Relations_Query('ru'))->findByHashtagTitleAndQuestionID('tag', 0);
    }

    public function test__QuestionIDBelowZero__ThrowException()
    {
        $this->expectExceptionMessage('HashtagToQuestion relation "questionID" property -1 must be greater than or equal to 1');
        $ERs = (new HashtagsToQuestions_Relations_Query('ru'))->findByHashtagTitleAndQuestionID('tag', -1);
    }
}
