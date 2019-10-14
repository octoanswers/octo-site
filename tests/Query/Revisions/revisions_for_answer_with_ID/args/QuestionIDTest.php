<?php

namespace Test\Query\Revisions\revisions_for_answer_with_ID;

class QuestionIDTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['revisions', 'questions']];

    public function test__Question_with_ID_not_exists()
    {
        $questionID = 667;

        $this->expectExceptionMessage('Question with ID "667" not exists');
        $actualResponse = (new \Query\Revisions('ru'))->revisions_for_answer_with_ID($questionID);
    }

    public function test__Question_ID_equal_zero()
    {
        $questionID = 0;

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $actualResponse = (new \Query\Revisions('ru'))->revisions_for_answer_with_ID($questionID);
    }

    public function test__Question_ID_is_negative()
    {
        $questionID = -1;

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $actualResponse = (new \Query\Revisions('ru'))->revisions_for_answer_with_ID($questionID);
    }
}
