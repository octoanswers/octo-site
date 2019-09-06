<?php

class Validator_Question_BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_validate_existsQuestionWithFullParams_Ok()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->title = 'How iPhone 8 are charged?';
        $question->isRedirect = true;

        $this->assertEquals(true, Question_Validator::validate_exists($question));
    }

    public function test_validate_existsQuestionWithMinParams_Ok()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals(true, Question_Validator::validate_exists($question));
    }
}
