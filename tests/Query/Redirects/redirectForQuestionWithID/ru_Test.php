<?php

class Question_Redirects_Query__redirectForQuestionWithID__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['redirects_questions']];

    public function test_base()
    {
        $redirect = (new Question_Redirects_Query('ru'))->redirectForQuestionWithID(30);

        $this->assertEquals(30, $redirect->fromID);
        $this->assertEquals('Был ли мальчик?', $redirect->toTitle);
    }

    public function test_RedirectNotExists()
    {
        $this->expectExceptionMessage('Redirect for question with ID "145" not exists');
        $redirect = (new Question_Redirects_Query('ru'))->redirectForQuestionWithID(145);
    }
}
