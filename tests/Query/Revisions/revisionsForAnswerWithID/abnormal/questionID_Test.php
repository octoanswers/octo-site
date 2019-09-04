<?php

class Query_Revisions_revisions_for_answer_with_ID_NegativeQuestionIDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions']];

    public function testQuestionWithThisIDNotExists()
    {
        $questionID = 667;

        $this->expectExceptionMessage('Question with ID "667" not exists');
        $actualResponse = (new Revisions_Query('ru'))->revisions_for_answer_with_ID($questionID);
    }
}
