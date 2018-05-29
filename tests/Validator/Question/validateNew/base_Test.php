<?php

class Validator_Question_validateNew_BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_ValidateNewQuestionWithFullParams_Ok()
    {
        $question = new Question_Model();
        $question->setTitle('How iPhone 8 are charged?');
        $question->setRedirect(true);

        $this->assertEquals(true, Question_Validator::validateNew($question));
    }

    public function test_ValidateNewQuestionWithMinParams_Ok()
    {
        $question = new Question_Model();
        $question->setTitle('How iPhone 8 are charged?');

        $this->assertEquals(true, Question_Validator::validateNew($question));
    }
}
