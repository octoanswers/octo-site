<?php

class Model_ER_HashtagsQuestions__initWithHashtagIDAndQuestionID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = HashtagsToQuestions_Relation_Model::initWithHashtagIDAndQuestionID(3, 9);

        $this->assertEquals(null, $rel->getID());
        $this->assertEquals(3, $rel->hashtagID);
        $this->assertEquals(9, $rel->questionID);
        $this->assertEquals(null, $rel->createdAt);
    }
}
