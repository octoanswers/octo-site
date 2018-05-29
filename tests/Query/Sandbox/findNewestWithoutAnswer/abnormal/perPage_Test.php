<?php

class Sandbox_Query__findNewestWithoutAnswer_perPage_Test extends Abstract_DB_TestCase
{
    public function test_PerPageParamEqualZero_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param 0 must be greater than or equal to 5');
        $questions = (new Sandbox_Query('ru'))->findNewestWithoutAnswer(1, 0);
    }

    public function test_PerPageParamBelowZero_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param -1 must be greater than or equal to 5');
        $questions = (new Sandbox_Query('ru'))->findNewestWithoutAnswer(1, -1);
    }

    public function test_PerPageParamBelowMinValue_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param 4 must be greater than or equal to 5');
        $questions = (new Sandbox_Query('ru'))->findNewestWithoutAnswer(1, 4);
    }

    public function test_PerPageParamGreaterThan100_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param 101 must be less than or equal to 100');
        $questions = (new Sandbox_Query('ru'))->findNewestWithoutAnswer(1, 101);
    }
}
