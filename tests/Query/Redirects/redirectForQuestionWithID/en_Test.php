<?php

class Question_Redirects_Query__redirectForQuestionWithID__en__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['redirects_questions']];

    public function test_base()
    {
        $redirect = (new Question_Redirects_Query('en'))->redirectForQuestionWithID(7);

        $this->assertEquals(7, $redirect->fromID);
        $this->assertEquals('How many showflakes in showrain?', $redirect->toTitle);
    }

    public function test_RedirectNotExists()
    {
        $this->expectExceptionMessage('Redirect for question with ID "457" not exists');
        $redirect = (new Question_Redirects_Query('en'))->redirectForQuestionWithID(457);
    }
}
