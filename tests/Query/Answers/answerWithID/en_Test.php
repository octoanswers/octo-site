<?php

class Query_Answers__answerWithID__en__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['questions']];

    public function testQuestionWithAnswer()
    {
        $answer = (new Answers_Query('en'))->answerWithID(6);

        $this->assertEquals(6, $answer->getID());
        $this->assertEquals('Yes, birds are mark his territory.', $answer->text);
    }
}
