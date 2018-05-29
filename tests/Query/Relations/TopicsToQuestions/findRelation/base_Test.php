<?php

class TopicsToQuestions_Relations_Query__findByTopicIDAndQuestionID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_topics_questions']];

    public function test__RelationExists()
    {
        $er = (new TopicsToQuestions_Relations_Query('ru'))->findByTopicIDAndQuestionID(58, 19);

        $this->assertEquals(14, $er->getID());
        $this->assertEquals(58, $er->getTopicID());
        $this->assertEquals(19, $er->getQuestionID());
    }

    public function test__RelationNotExists()
    {
        $er = (new TopicsToQuestions_Relations_Query('ru'))->findByTopicIDAndQuestionID(3, 33);

        $this->assertEquals(null, $er);
    }
}
