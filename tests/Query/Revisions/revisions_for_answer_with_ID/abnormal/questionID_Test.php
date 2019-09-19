<?php

class Query_Revisions__revisions_for_answer_with_ID__abnormal__question_IDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions']];

    public function test__Question_with_ID_not_exists()
    {
        $questionID = 667;

        $this->expectExceptionMessage('Question with ID "667" not exists');
        $actualResponse = (new \Query\Revisions('ru'))->revisions_for_answer_with_ID($questionID);
    }
}
