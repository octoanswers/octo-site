<?php

class Redirect_Validator__validateTest extends PHPUnit\Framework\TestCase
{
    public function test_Validate_exists_question_with_full_params()
    {
        $redirect = new Question_Redirect_Model();
        $redirect->fromID = 12;
        $redirect->toTitle = 'How iPhone 8 are charged?';

        $this->assertEquals(true, Question_Redirect_Validator::validate($redirect));
    }
}
