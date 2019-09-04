<?php

class Query_Answers__answer_with_ID__en__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['questions']];

    public function testQuestionWithAnswer()
    {
        $answer = (new Answers_Query('en'))->answer_with_ID(6);

        $this->assertEquals(6, $answer->id);
        $this->assertEquals('Yes, birds are mark his territory.', $answer->text);
    }
}
