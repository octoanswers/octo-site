<?php

class Model_ER_TopicsQuestions__initWithTopicIDAndQuestionID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = TopicsToQuestions_Relation_Model::initWithTopicIDAndQuestionID(3, 9);

        $this->assertEquals(null, $rel->getID());
        $this->assertEquals(3, $rel->getTopicID());
        $this->assertEquals(9, $rel->getQuestionID());
        $this->assertEquals(null, $rel->getCreatedAt());
    }
}
