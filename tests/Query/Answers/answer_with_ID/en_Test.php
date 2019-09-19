<?php

class Query_Answers__answer_with_ID__enTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Question_with_answer()
    {
        $answer = (new \Query\Answers('en'))->answer_with_ID(6);

        $this->assertEquals(6, $answer->id);
        $this->assertEquals('Yes, birds are mark his territory.', $answer->text);
    }
}
