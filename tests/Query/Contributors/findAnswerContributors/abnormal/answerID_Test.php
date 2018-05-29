<?php

class Query_Contributions__findAnswerContributors__abnormal__answerID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions', 'questions']];

    public function testQuestionWithThisIDNotExists()
    {
        $this->expectExceptionMessage('Question with ID "667" not exists');
        $actualResponse = (new Contributors_Query('ru'))->findAnswerContributors(667);
    }
}
