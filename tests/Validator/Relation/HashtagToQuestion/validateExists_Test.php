<?php

class Validator_ER_HashtagsQuestions__validateExists__Test extends PHPUnit\Framework\TestCase
{
    public function test__FullParams__OK()
    {
        $rel = new HashtagsToQuestions_Relation_Model();
        $rel->setID(13);
        $rel->setTopicID(3);
        $rel->setQuestionID(9);
        $rel->setCreatedAt('2015-11-29 09:28:34');

        $this->assertEquals(true, TopicToQuestion_Relation_Validator::validateExists($rel));
    }

    public function test__MinParams__OK()
    {
        $rel = new HashtagsToQuestions_Relation_Model();
        $rel->setID(13);
        $rel->setTopicID(3);
        $rel->setQuestionID(9);

        $this->assertEquals(true, TopicToQuestion_Relation_Validator::validateExists($rel));
    }
}
