<?php

class Query_Users__users_newest__negative__pageTest extends Abstract_DB_TestCase
{
    public function test__Page_param_below_zero()
    {
        $this->expectExceptionMessage('Optional "page" param -1 must be greater than or equal to 0');
        $actualResponse = (new Users_Query())->users_newest(-1);
    }

    public function test__Page_param_greater_than_9999()
    {
        $this->expectExceptionMessage('Optional "page" param 10000 must be less than or equal to 9999');
        $actualResponse = (new Users_Query())->users_newest(10000);
    }
}
