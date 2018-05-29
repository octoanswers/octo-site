<?php

class Question_Query__questionWithID__en__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['questions']];

    public function testQuestionWithAnswer()
    {
        $question = (new Question_Query('en'))->questionWithID(6);

        $this->assertEquals(6, $question->getID());
        $this->assertEquals('How birds are mark his territory?', $question->getTitle());
        $this->assertEquals('4_2013_05_09_123', $question->getImageBaseName());
    }
}
