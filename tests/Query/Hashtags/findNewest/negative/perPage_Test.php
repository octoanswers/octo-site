<?php

use PHPUnit\Framework\TestCase;

class Hashtags_Query__findNewest_perPage_Test extends TestCase
{
    public function test_PerPageParamEqualZero_ThrowException()
    {
        $this->expectExceptionMessage('List "perPage" param 0 must be greater than or equal to 5');
        $hashtags = (new Hashtags_Query('ru'))->findNewest(1, 0);
    }

    public function test_PerPageParamBelowZero_ThrowException()
    {
        $this->expectExceptionMessage('List "perPage" param -1 must be greater than or equal to 5');
        $hashtags = (new Hashtags_Query('ru'))->findNewest(1, -1);
    }

    public function test_PerPageParamBelowMinValue_ThrowException()
    {
        $this->expectExceptionMessage('List "perPage" param 4 must be greater than or equal to 5');
        $hashtags = (new Hashtags_Query('ru'))->findNewest(1, 4);
    }

    public function test_PerPageParamGreaterThan100_ThrowException()
    {
        $this->expectExceptionMessage('List "perPage" param 101 must be less than or equal to 100');
        $hashtags = (new Hashtags_Query('ru'))->findNewest(1, 101);
    }
}
