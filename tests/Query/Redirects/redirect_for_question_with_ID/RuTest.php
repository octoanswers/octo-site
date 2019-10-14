<?php

namespace Test\Query\Redirects\Question\redirectForQuestionWithID;

class RuTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['redirects_questions']];

    public function test__Redirect_exists()
    {
        $redirect = (new \Query\Redirects\Question('ru'))->redirectForQuestionWithID(30);

        $this->assertEquals(30, $redirect->fromID);
        $this->assertEquals('Был ли мальчик?', $redirect->toTitle);
    }

    public function test__Redirect_not_exists()
    {
        $this->expectExceptionMessage('Redirect for question with ID "145" not exists');
        $redirect = (new \Query\Redirects\Question('ru'))->redirectForQuestionWithID(145);
    }
}
