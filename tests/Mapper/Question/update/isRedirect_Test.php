<?php

class Mapper_Question_update_isRedirect_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test_UpdateWithNotBoolRedirectParam_Ok()
    {
        $question = new Question_Model();
        $question->setID(2);
        $question->title = 'This is question?';
        $question->setRedirect('true');

        $question = (new Question_Mapper('ru'))->update($question);
        $this->assertEquals(true, $question->isRedirect());
    }

    public function test_UpdateWithZeroRedirectParam_Ok()
    {
        $question = new Question_Model();
        $question->setID(2);
        $question->title = 'This is question?';
        $question->setRedirect('0');

        $question = (new Question_Mapper('ru'))->update($question);
        $this->assertEquals(false, $question->isRedirect());
    }
}
