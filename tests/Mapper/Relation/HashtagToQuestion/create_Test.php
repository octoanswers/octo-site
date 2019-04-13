<?php

class Mapper_ER_TopicsQuestions__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_topics_questions']];

    public function test__FullParams__OK()
    {
        $er = new HashtagsToQuestions_Relation_Model();
        $er->setTopicID(3);
        $er->setQuestionID(9);

        $er = (new HashtagToQuestion_Relation_Mapper('ru'))->create($er);

        $this->assertEquals(25, $er->getID());
        $this->assertEquals(3, $er->getTopicID());
        $this->assertEquals(9, $er->getQuestionID());
    }

    public function test__MinParams__OK()
    {
        $er = new HashtagsToQuestions_Relation_Model();
        $er->setTopicID(3);
        $er->setQuestionID(9);

        $er = (new HashtagToQuestion_Relation_Mapper('ru'))->create($er);

        $this->assertEquals(25, $er->getID());
        $this->assertEquals(3, $er->getTopicID());
        $this->assertEquals(9, $er->getQuestionID());
    }
}
