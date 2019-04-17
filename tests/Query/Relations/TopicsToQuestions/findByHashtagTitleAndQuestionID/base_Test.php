<?php

class Query_ER_HashtagsQuestions__findByHashtagTitleAndQuestionID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['hashtags', 'er_hashtags_questions']];

    public function test__RelationExists()
    {
        $er = (new HashtagsToQuestions_Relations_Query('ru'))->findByHashtagTitleAndQuestionID('птицы', 22);

        $this->assertEquals(21, $er->getID());
        $this->assertEquals(13, $er->getHashtagID());
        $this->assertEquals(22, $er->questionID);
    }

    public function test__RelationNotExists()
    {
        $er = (new HashtagsToQuestions_Relations_Query('ru'))->findByHashtagTitleAndQuestionID('tagnotexists', 12);

        $this->assertEquals(null, $er);
    }
}
