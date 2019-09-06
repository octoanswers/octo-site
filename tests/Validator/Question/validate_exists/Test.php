<?php

class Validator_Question__validate_existsTest extends PHPUnit\Framework\TestCase
{
    public function test__Exists_question_with_full_params()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->title = 'How iPhone 8 are charged?';
        $question->isRedirect = true;

        $this->assertEquals(true, Question_Validator::validate_exists($question));
    }

    public function test__Exists_question_with_min_params()
    {
        $question = new Question_Model();
        $question->id = 13;
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals(true, Question_Validator::validate_exists($question));
    }
}
