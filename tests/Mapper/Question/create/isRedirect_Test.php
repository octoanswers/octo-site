<?php

class Mapper_Question_create_isRedirect_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_CreateWithIsRedirectParam_Ok()
    {
        $question = new Question_Model();
        $question->title = 'This is question?';
        $question->isRedirect = true;

        $question = (new Question_Mapper('ru'))->create($question);
        $this->assertEquals(34, $question->id);
        $this->assertEquals(true, $question->isRedirect);
    }
}
