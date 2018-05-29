<?php

class Query_ER_TopicsQuestions__findByTopicTitleAndQuestionID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['topics', 'er_topics_questions']];

    public function test__RelationExists()
    {
        $er = (new TopicsToQuestions_Relations_Query('ru'))->findByTopicTitleAndQuestionID('птицы', 22);

        $this->assertEquals(21, $er->getID());
        $this->assertEquals(13, $er->getTopicID());
        $this->assertEquals(22, $er->getQuestionID());
    }

    public function test__RelationNotExists()
    {
        $er = (new TopicsToQuestions_Relations_Query('ru'))->findByTopicTitleAndQuestionID('tagnotexists', 12);

        $this->assertEquals(null, $er);
    }
}
