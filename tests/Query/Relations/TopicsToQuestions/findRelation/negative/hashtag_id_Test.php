<?php

use PHPUnit\Framework\TestCase;

class Query_ER_HashtagsQuestions__findByHashtagIDAndQuestionID__hashtag_id__Test extends TestCase
{
    public function test__HashtagIDEqualZero_ThrowException()
    {
        $this->expectExceptionMessage('HashtagToQuestion relation "hashtagID" property 0 must be greater than or equal to 1');
        $ERs = (new HashtagsToQuestions_Relations_Query('ru'))->findByHashtagIDAndQuestionID(0, 1);
    }

    public function test__HashtagIDBelowZero_ThrowException()
    {
        $this->expectExceptionMessage('HashtagToQuestion relation "hashtagID" property -1 must be greater than or equal to 1');
        $ERs = (new HashtagsToQuestions_Relations_Query('ru'))->findByHashtagIDAndQuestionID(-1, 1);
    }
}
