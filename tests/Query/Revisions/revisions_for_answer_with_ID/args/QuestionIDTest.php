<?php

namespace Test\Query\Revisions\revisionsForAnswerWithID;

class QuestionIDTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['revisions', 'questions']];

    public function test__questionWithID_not_exists()
    {
        $questionID = 667;

        $this->expectExceptionMessage('Question with ID "667" not exists');
        $actualResponse = (new \Query\Revisions('ru'))->revisionsForAnswerWithID($questionID);
    }

    public function test__Question_ID_equal_zero()
    {
        $questionID = 0;

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $actualResponse = (new \Query\Revisions('ru'))->revisionsForAnswerWithID($questionID);
    }

    public function test__Question_ID_is_negative()
    {
        $questionID = -1;

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $actualResponse = (new \Query\Revisions('ru'))->revisionsForAnswerWithID($questionID);
    }
}
