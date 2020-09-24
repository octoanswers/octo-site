<?php

namespace Test\Query\Categories\findNewest;

use PHPUnit\Framework\TestCase;

class PerPageTest extends TestCase
{
    public function test__PerPage_param_equal_zero()
    {
        $this->expectExceptionMessage('List "perPage" param 0 must be greater than or equal to 5');
        $categories = (new \Query\Categories('ru'))->findNewest(1, 0);
    }

    public function test__PerPage_param_below_zero()
    {
        $this->expectExceptionMessage('List "perPage" param -1 must be greater than or equal to 5');
        $categories = (new \Query\Categories('ru'))->findNewest(1, -1);
    }

    public function test__PerPage_param_below_min_value()
    {
        $this->expectExceptionMessage('List "perPage" param 4 must be greater than or equal to 5');
        $categories = (new \Query\Categories('ru'))->findNewest(1, 4);
    }

    public function test__PerPage_param_greater_than_100()
    {
        $this->expectExceptionMessage('List "perPage" param 101 must be less than or equal to 100');
        $categories = (new \Query\Categories('ru'))->findNewest(1, 101);
    }
}
