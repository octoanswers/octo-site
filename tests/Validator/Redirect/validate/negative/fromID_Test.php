<?php

class Redirect_Validator__validate_id__Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $redirect = new Redirect_Model();
        $redirect->fromID = 0;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $this->expectExceptionMessage('Redirect "fromID" property 0 must be greater than or equal to 1');
        Redirect_Validator::validate($redirect);
    }

    public function test_fromIDBelowZero()
    {
        $redirect = new Redirect_Model();
        $redirect->fromID = -1;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $this->expectExceptionMessage('Redirect "fromID" property -1 must be greater than or equal to 1');
        Redirect_Validator::validate($redirect);
    }
}
