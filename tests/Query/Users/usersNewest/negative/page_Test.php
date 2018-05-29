<?php

class Query_Users_usersNewest_negative_page_Test extends Abstract_DB_TestCase
{
    public function testPageBelowZero()
    {
        $this->expectExceptionMessage('Optional "page" param -1 must be greater than or equal to 0');
        $actualResponse = (new Users_Query())->usersNewest(-1);
    }

    public function testPageGreaterThan9999()
    {
        $this->expectExceptionMessage('Optional "page" param 10000 must be less than or equal to 9999');
        $actualResponse = (new Users_Query())->usersNewest(10000);
    }
}
