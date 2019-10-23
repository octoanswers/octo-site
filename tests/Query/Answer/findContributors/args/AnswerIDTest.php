<?php

namespace Test\Query\Answer\findContributors;

class AnswerIDTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['revisions', 'questions']];

    public function test__Answer_ID_equal_zero()
    {
        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        $actualResponse = (new \Query\Answer('ru'))->findContributors(0);
    }

    public function test__Answer_ID_is_negative()
    {
        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        $actualResponse = (new \Query\Answer('ru'))->findContributors(-1);
    }

    public function test__Answer_ID_not_exists()
    {
        $this->expectExceptionMessage('Question with ID "667" not exists');
        $actualResponse = (new \Query\Answer('ru'))->findContributors(667);
    }
}
