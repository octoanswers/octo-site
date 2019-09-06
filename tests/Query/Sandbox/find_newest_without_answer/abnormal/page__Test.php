<?php

class Query_Sandbox__find_newest_without_answer__abnormal__pageTest extends Abstract_DB_TestCase
{
    public function test__Page_param_equal_zero()
    {
        $this->expectExceptionMessage('Questions list page param 0 must be greater than or equal to 1');
        $questions = (new Sandbox_Query('ru'))->find_newest_without_answer(0);
    }

    public function test__Page_param_below_zero()
    {
        $this->expectExceptionMessage('Questions list page param -1 must be greater than or equal to 1');
        $questions = (new Sandbox_Query('ru'))->find_newest_without_answer(-1);
    }

    public function test__Page_param_greater_than_9999()
    {
        $this->expectExceptionMessage('Questions list page param 10000 must be less than or equal to 9999');
        $questions = (new Sandbox_Query('ru'))->find_newest_without_answer(10000);
    }
}
