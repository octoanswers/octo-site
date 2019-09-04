<?php

use PHPUnit\Framework\TestCase;

class Categories_Query__find_newest_perPage_Test extends TestCase
{
    public function test_PerPageParamEqualZero_ThrowException()
    {
        $this->expectExceptionMessage('List "perPage" param 0 must be greater than or equal to 5');
        $categories = (new Categories_Query('ru'))->find_newest(1, 0);
    }

    public function test_PerPageParamBelowZero_ThrowException()
    {
        $this->expectExceptionMessage('List "perPage" param -1 must be greater than or equal to 5');
        $categories = (new Categories_Query('ru'))->find_newest(1, -1);
    }

    public function test_PerPageParamBelowMinValue_ThrowException()
    {
        $this->expectExceptionMessage('List "perPage" param 4 must be greater than or equal to 5');
        $categories = (new Categories_Query('ru'))->find_newest(1, 4);
    }

    public function test_PerPageParamGreaterThan100_ThrowException()
    {
        $this->expectExceptionMessage('List "perPage" param 101 must be less than or equal to 100');
        $categories = (new Categories_Query('ru'))->find_newest(1, 101);
    }
}
