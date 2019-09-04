<?php

class Query_Questions_find_newest__negative__perPage__Test extends Abstract_DB_TestCase
{
    public function test_PerPageParamEqualZero_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param 0 must be greater than or equal to 5');
        $questions = (new Questions_Query('ru'))->find_newest(1, 0);
    }

    public function test_PerPageParamBelowZero_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param -1 must be greater than or equal to 5');
        $questions = (new Questions_Query('ru'))->find_newest(1, -1);
    }

    public function test_PerPageParamBelowMinValue_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param 4 must be greater than or equal to 5');
        $questions = (new Questions_Query('ru'))->find_newest(1, 4);
    }

    public function test_PerPageParamGreaterThan100_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param 101 must be less than or equal to 100');
        $questions = (new Questions_Query('ru'))->find_newest(1, 101);
    }
}
