<?php

class Query_Revisions_revisionsForAnswerWithID_NegativeQuestionIDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions']];

    public function testQuestionWithThisIDNotExists()
    {
        $questionID = 667;

        $this->expectExceptionMessage('Question with ID "667" not exists');
        $actualResponse = (new Revisions_Query('ru'))->revisionsForAnswerWithID($questionID);
    }
}
