<?php

namespace Test\Query\Redirects\Question\redirectForQuestionWithID;

class EnTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['en' => ['redirects_questions']];

    public function test__Redirect_exists()
    {
        $redirect = (new \Query\Redirects\Question('en'))->redirectForQuestionWithID(7);

        $this->assertEquals(7, $redirect->fromID);
        $this->assertEquals('How many showflakes in showrain?', $redirect->toTitle);
    }

    public function test__Redirect_not_exists()
    {
        $this->expectExceptionMessage('Redirect for question with ID "457" not exists');
        $redirect = (new \Query\Redirects\Question('en'))->redirectForQuestionWithID(457);
    }
}
