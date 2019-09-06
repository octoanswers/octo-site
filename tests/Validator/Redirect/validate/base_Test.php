<?php

class Redirect_Validator__validate_exists__Test extends PHPUnit\Framework\TestCase
{
    public function test_validate_existsQuestionWithFullParams_Ok()
    {
        $redirect = new Question_Redirect_Model();
        $redirect->fromID = 12;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $this->assertEquals(true, Question_Redirect_Validator::validate($redirect));
    }
}
