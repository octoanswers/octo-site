<?php

class HashtagsToQuestions_Relations_Query__findByHashtagIDAndQuestionID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_hashtags_questions']];

    public function test__RelationExists()
    {
        $er = (new HashtagsToQuestions_Relations_Query('ru'))->findByHashtagIDAndQuestionID(58, 19);

        $this->assertEquals(14, $er->id);
        $this->assertEquals(58, $er->hashtagID);
        $this->assertEquals(19, $er->questionID);
    }

    public function test__RelationNotExists()
    {
        $er = (new HashtagsToQuestions_Relations_Query('ru'))->findByHashtagIDAndQuestionID(3, 33);

        $this->assertEquals(null, $er);
    }
}
