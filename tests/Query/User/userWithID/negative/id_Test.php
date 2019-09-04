<?php

class Query_Users_user_with_ID_negative_ID_Test extends Abstract_DB_TestCase
{
    public function testIDEqualZero()
    {
        $this->expectExceptionMessage('User id param 0 must be greater than or equal to 1');
        (new User_Query())->user_with_ID(0);
    }

    public function testIDBelowZero()
    {
        $this->expectExceptionMessage('User id param -1 must be greater than or equal to 1');
        (new User_Query())->user_with_ID(-1);
    }
}
