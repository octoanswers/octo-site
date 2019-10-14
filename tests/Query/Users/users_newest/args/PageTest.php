<?php

namespace Test\Query\Users\users_newest;

class PageTest extends \Test\TestCase\DB
{
    public function test__Page_param_below_zero()
    {
        $this->expectExceptionMessage('Optional "page" param -1 must be greater than or equal to 0');
        $actualResponse = (new \Query\Users())->users_newest(-1);
    }

    public function test__Page_param_greater_than_9999()
    {
        $this->expectExceptionMessage('Optional "page" param 10000 must be less than or equal to 9999');
        $actualResponse = (new \Query\Users())->users_newest(10000);
    }
}
