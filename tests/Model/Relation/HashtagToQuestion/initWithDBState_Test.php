<?php

class Model_ER_TopicsQuestions__initWithDBState__Test extends PHPUnit\Framework\TestCase
{
    public function test__EnFullParams_ReturnObject()
    {
        $rel = HashtagsToQuestions_Relation_Model::initWithDBState([
            'er_id' => 13,
            'er_topic_id' => 3,
            'er_question_id' => 9,
            'er_created_at' => '2015-11-29 09:28:34'
        ]);

        $this->assertEquals(13, $rel->getID());
        $this->assertEquals(3, $rel->getTopicID());
        $this->assertEquals(9, $rel->getQuestionID());
        $this->assertEquals('2015-11-29 09:28:34', $rel->getCreatedAt());
    }

    public function test_RuFullParams_ReturnObject()
    {
        $rel = HashtagsToQuestions_Relation_Model::initWithDBState([
            'er_id' => 13,
            'er_topic_id' => 3,
            'er_question_id' => 9,
            'er_created_at' => '2015-11-29 09:28:34'
        ]);

        $this->assertEquals(13, $rel->getID());
        $this->assertEquals(3, $rel->getTopicID());
        $this->assertEquals(9, $rel->getQuestionID());
        $this->assertEquals('2015-11-29 09:28:34', $rel->getCreatedAt());
    }
}
