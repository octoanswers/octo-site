<?php

class Validator_Question_BaseTest extends PHPUnit\Framework\TestCase
{
    public function test_ValidateExistsQuestionWithFullParams_Ok()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->title = 'How iPhone 8 are charged?';
        $question->setRedirect(true);

        $this->assertEquals(true, Question_Validator::validateExists($question));
    }

    public function test_ValidateExistsQuestionWithMinParams_Ok()
    {
        $question = new Question_Model();
        $question->setID(13);
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals(true, Question_Validator::validateExists($question));
    }
}
