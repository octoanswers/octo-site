<?php

class Mapper_Question_create_isRedirect_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_CreateWithNotBoolRedirectParam_Ok()
    {
        $question = new Question_Model();
        $question->title = 'This is question?';
        $question->setRedirect('true');

        $question = (new Question_Mapper('ru'))->create($question);
        $this->assertEquals(true, $question->isRedirect());
    }

    public function test_CreateWithZeroRedirectParam_Ok()
    {
        $question = new Question_Model();
        $question->title = 'This is question?';
        $question->setRedirect('0');

        $question = (new Question_Mapper('ru'))->create($question);
        $this->assertEquals(false, $question->isRedirect());
    }
}
