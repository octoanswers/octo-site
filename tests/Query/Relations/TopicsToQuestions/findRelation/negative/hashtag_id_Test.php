<?php

use PHPUnit\Framework\TestCase;

class Query_ER_TopicsQuestions__findByTopicIDAndQuestionID__topic_id__Test extends TestCase
{
    public function test__TopicIDEqualZero_ThrowException()
    {
        $this->expectExceptionMessage('TopicToQuestion relation "topicID" property 0 must be greater than or equal to 1');
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findByTopicIDAndQuestionID(0, 1);
    }

    public function test__TopicIDBelowZero_ThrowException()
    {
        $this->expectExceptionMessage('TopicToQuestion relation "topicID" property -1 must be greater than or equal to 1');
        $ERs = (new TopicsToQuestions_Relations_Query('ru'))->findByTopicIDAndQuestionID(-1, 1);
    }
}
