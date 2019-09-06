<?php

use PHPUnit\Framework\TestCase;

class Query_Categories__find_newest__negative__per_pageTest extends TestCase
{
    public function test__PerPage_param_equal_zero()
    {
        $this->expectExceptionMessage('List "perPage" param 0 must be greater than or equal to 5');
        $categories = (new Categories_Query('ru'))->find_newest(1, 0);
    }

    public function test__PerPage_param_below_zero()
    {
        $this->expectExceptionMessage('List "perPage" param -1 must be greater than or equal to 5');
        $categories = (new Categories_Query('ru'))->find_newest(1, -1);
    }

    public function test__PerPage_param_below_min_value()
    {
        $this->expectExceptionMessage('List "perPage" param 4 must be greater than or equal to 5');
        $categories = (new Categories_Query('ru'))->find_newest(1, 4);
    }

    public function test__PerPage_param_greater_than_100()
    {
        $this->expectExceptionMessage('List "perPage" param 101 must be less than or equal to 100');
        $categories = (new Categories_Query('ru'))->find_newest(1, 101);
    }
}
