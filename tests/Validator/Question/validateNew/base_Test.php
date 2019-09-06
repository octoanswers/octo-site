<?php

class Validator_Question_validate_new_BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_validate_newQuestionWithFullParams_Ok()
    {
        $question = new Question_Model();
        $question->title = 'How iPhone 8 are charged?';
        $question->isRedirect = true;

        $this->assertEquals(true, Question_Validator::validate_new($question));
    }

    public function test_validate_newQuestionWithMinParams_Ok()
    {
        $question = new Question_Model();
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals(true, Question_Validator::validate_new($question));
    }
}
