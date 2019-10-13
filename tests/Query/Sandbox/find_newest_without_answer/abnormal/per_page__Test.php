<?php

class Query_Search__search_categories__negative__queryTest extends \Tests\DB\TestCase
{
    public function test__PerPage_param_equal_zero()
    {
        $this->expectExceptionMessage('Questions list perPage param 0 must be greater than or equal to 5');
        $questions = (new \Query\Sandbox('ru'))->find_newest_without_answer(1, 0);
    }

    public function test__PerPage_param_below_zero()
    {
        $this->expectExceptionMessage('Questions list perPage param -1 must be greater than or equal to 5');
        $questions = (new \Query\Sandbox('ru'))->find_newest_without_answer(1, -1);
    }

    public function test__PerPage_param_below_min_value()
    {
        $this->expectExceptionMessage('Questions list perPage param 4 must be greater than or equal to 5');
        $questions = (new \Query\Sandbox('ru'))->find_newest_without_answer(1, 4);
    }

    public function test__PerPage_param_greater_than_100()
    {
        $this->expectExceptionMessage('Questions list perPage param 101 must be less than or equal to 100');
        $questions = (new \Query\Sandbox('ru'))->find_newest_without_answer(1, 101);
    }
}
