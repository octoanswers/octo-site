<?php

use PHPUnit\Framework\TestCase;

class Query_ER_TopicsQuestions__findByTopicTitleAndQuestionID__question_id__Test extends TestCase
{
    public function test__QuestionIDEqualZero__ThrowException()
    {
        $this->expectExceptionMessage('TopicToQuestion relation "questionID" property 0 must be greater than or equal to 1');
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findByTopicTitleAndQuestionID('tag', 0);
    }

    public function test__QuestionIDBelowZero__ThrowException()
    {
        $this->expectExceptionMessage('TopicToQuestion relation "questionID" property -1 must be greater than or equal to 1');
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findByTopicTitleAndQuestionID('tag', -1);
    }
}
