<?php

namespace Test\Query\Categories\find_newest;

use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    public function test__Page_param_equal_zero()
    {
        $this->expectExceptionMessage('List "page" param 0 must be greater than or equal to 1');
        $categories = (new \Query\Categories('ru'))->find_newest(0);
    }

    public function test__Page_param_below_zero()
    {
        $this->expectExceptionMessage('List "page" param -1 must be greater than or equal to 1');
        $categories = (new \Query\Categories('ru'))->find_newest(-1);
    }

    public function test_Page_param_greater_than_9999()
    {
        $this->expectExceptionMessage('List "page" param 10000 must be less than or equal to 9999');
        $categories = (new \Query\Categories('ru'))->find_newest(10000);
    }
}
