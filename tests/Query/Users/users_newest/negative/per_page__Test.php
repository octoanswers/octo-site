<?php

class Query_Users__users_newest__negative__per_pageTest extends Abstract_DB_TestCase
{
    public function test__PerPage_param_equal_zero()
    {
        $this->expectExceptionMessage('Optional "perPage" param 4 must be greater than or equal to 5');
        $actualResponse = (new Users_Query())->users_newest(0, 4);
    }

    public function test__PerPage_param_below_zero()
    {
        $this->expectExceptionMessage('Optional "perPage" param -1 must be greater than or equal to 5');
        $actualResponse = (new Users_Query())->users_newest(0, -1);
    }

    public function test__PerPage_param_greater_than_100()
    {
        $this->expectExceptionMessage('Optional "perPage" param 101 must be less than or equal to 100');
        $users = (new Users_Query())->users_newest(0, 101);
    }
}
