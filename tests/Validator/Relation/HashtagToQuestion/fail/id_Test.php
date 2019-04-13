<?php

class Validator_ER_HashtagQuestions__id__Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $rel = new HashtagsToQuestions_Relation_Model();
        $rel->setID(0);
        $rel->setTopicID(3);
        $rel->setQuestionID(9);

        $this->expectExceptionMessage('TopicToQuestion relation "id" property 0 must be greater than or equal to 1');
        TopicToQuestion_Relation_Validator::validateExists($rel);
    }

    public function test__IDBelowZero()
    {
        $rel = new HashtagsToQuestions_Relation_Model();
        $rel->setID(-1);
        $rel->setTopicID(3);
        $rel->setQuestionID(9);

        $this->expectExceptionMessage('TopicToQuestion relation "id" property -1 must be greater than or equal to 1');
        TopicToQuestion_Relation_Validator::validateExists($rel);
    }
}
