<?php

class Redirects_Query__redirectForQuestionWithID__en__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['redirects']];

    public function test_base()
    {
        $redirect = (new Redirects_Query('en'))->redirectForQuestionWithID(7);

        $this->assertEquals(7, $redirect->getFromID());
        $this->assertEquals('How many showflakes in showrain?', $redirect->getRedirectTitle());
    }

    public function test_RedirectNotExists()
    {
        $this->expectExceptionMessage('Redirect for question with ID "457" not exists');
        $redirect = (new Redirects_Query('en'))->redirectForQuestionWithID(457);
    }
}
