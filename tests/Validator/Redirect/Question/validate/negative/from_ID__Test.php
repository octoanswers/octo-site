<?php

class Validator_Redirect_Question__validate__negative__from_IDTest extends PHPUnit\Framework\TestCase
{
    public function test__FromID_equal_zero()
    {
        $redirect = new \Model\Redirect\Question();
        $redirect->fromID = 0;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $this->expectExceptionMessage('Redirect "fromID" property 0 must be greater than or equal to 1');
        \Validator\Redirect\Question::validate($redirect);
    }

    public function test__FromID_below_zero()
    {
        $redirect = new \Model\Redirect\Question();
        $redirect->fromID = -1;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $this->expectExceptionMessage('Redirect "fromID" property -1 must be greater than or equal to 1');
        \Validator\Redirect\Question::validate($redirect);
    }
}
