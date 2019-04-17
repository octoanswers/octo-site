<?php

class Redirect_Validator__validateExists__Test extends PHPUnit\Framework\TestCase
{
    public function test_ValidateExistsQuestionWithFullParams_Ok()
    {
        $redirect = new Redirect_Model();
        $redirect->fromID = 12;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $this->assertEquals(true, Redirect_Validator::validate($redirect));
    }
}
