<?php

class Mapper_ER_HashtagsQuestions__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_hashtags_questions']];

    public function test__FullParams__OK()
    {
        $er = new HashtagsToQuestions_Relation_Model();
        $er->hashtagID = 3;
        $er->questionID = 9;

        $er = (new HashtagToQuestion_Relation_Mapper('ru'))->create($er);

        $this->assertEquals(25, $er->id);
        $this->assertEquals(3, $er->hashtagID);
        $this->assertEquals(9, $er->questionID);
    }

    public function test__MinParams__OK()
    {
        $er = new HashtagsToQuestions_Relation_Model();
        $er->hashtagID = 3;
        $er->questionID = 9;

        $er = (new HashtagToQuestion_Relation_Mapper('ru'))->create($er);

        $this->assertEquals(25, $er->id);
        $this->assertEquals(3, $er->hashtagID);
        $this->assertEquals(9, $er->questionID);
    }
}
