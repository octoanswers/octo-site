<?php

class Redirects_Query__redirectForQuestionWithID__ru__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['redirects']];

    public function test_base()
    {
        $redirect = (new Redirects_Query('ru'))->redirectForQuestionWithID(30);

        $this->assertEquals(30, $redirect->getFromID());
        $this->assertEquals('Был ли мальчик?', $redirect->getRedirectTitle());
    }

    public function test_RedirectNotExists()
    {
        $this->expectExceptionMessage('Redirect for question with ID "145" not exists');
        $redirect = (new Redirects_Query('ru'))->redirectForQuestionWithID(145);
    }
}
