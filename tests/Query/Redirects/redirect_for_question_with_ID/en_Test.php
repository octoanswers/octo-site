<?php

class Query_Redirects_Question__redirect_for_question_with_ID__enTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['redirects_questions']];

    public function test__Redirect_exists()
    {
        $redirect = (new \Query\Redirects\Question('en'))->redirect_for_question_with_ID(7);

        $this->assertEquals(7, $redirect->fromID);
        $this->assertEquals('How many showflakes in showrain?', $redirect->toTitle);
    }

    public function test__Redirect_not_exists()
    {
        $this->expectExceptionMessage('Redirect for question with ID "457" not exists');
        $redirect = (new \Query\Redirects\Question('en'))->redirect_for_question_with_ID(457);
    }
}
