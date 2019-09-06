<?php

class Query_Questions__find_newest_with_answer__negative__pageTest extends Abstract_DB_TestCase
{
    public function test__Page_param_equal_zero()
    {
        $this->expectExceptionMessage('Questions list page param 0 must be greater than or equal to 1');
        $questions = (new Questions_Query('ru'))->find_newest_with_answer(0);
    }

    public function test__Page_param_below_zero()
    {
        $this->expectExceptionMessage('Questions list page param -1 must be greater than or equal to 1');
        $questions = (new Questions_Query('ru'))->find_newest_with_answer(-1);
    }

    public function test__Page_param_greater_than_9999()
    {
        $this->expectExceptionMessage('Questions list page param 10000 must be less than or equal to 9999');
        $questions = (new Questions_Query('ru'))->find_newest_with_answer(10000);
    }
}
