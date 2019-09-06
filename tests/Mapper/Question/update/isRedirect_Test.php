<?php

class Mapper_Question__update__isRedirect__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_UpdateWithIsRedirectParam_Ok()
    {
        $question = new Question_Model();
        $question->id = 2;
        $question->title = 'This is question?';
        $question->isRedirect = true;

        $question = (new Question_Mapper('ru'))->update($question);
        $this->assertEquals(2, $question->id);
        $this->assertEquals(true, $question->isRedirect);
    }
}
