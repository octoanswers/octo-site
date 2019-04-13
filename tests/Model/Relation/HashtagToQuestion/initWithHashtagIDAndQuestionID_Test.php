<?php

class Model_ER_HashtagsQuestions__initWithHashtagIDAndQuestionID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = HashtagsToQuestions_Relation_Model::initWithHashtagIDAndQuestionID(3, 9);

        $this->assertEquals(null, $rel->getID());
        $this->assertEquals(3, $rel->getHashtagID());
        $this->assertEquals(9, $rel->getQuestionID());
        $this->assertEquals(null, $rel->getCreatedAt());
    }
}
