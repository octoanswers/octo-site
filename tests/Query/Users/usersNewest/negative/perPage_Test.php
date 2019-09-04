<?php

class Query_Users_users_newest_negative_perPage_Test extends Abstract_DB_TestCase
{
    public function testPerPageEqualZero()
    {
        $this->expectExceptionMessage('Optional "perPage" param 4 must be greater than or equal to 5');
        $actualResponse = (new Users_Query())->users_newest(0, 4);
    }

    public function testPerPageBelowZero()
    {
        $this->expectExceptionMessage('Optional "perPage" param -1 must be greater than or equal to 5');
        $actualResponse = (new Users_Query())->users_newest(0, -1);
    }

    public function testPerPageGreaterThan100()
    {
        $this->expectExceptionMessage('Optional "perPage" param 101 must be less than or equal to 100');
        $users = (new Users_Query())->users_newest(0, 101);
    }
}
