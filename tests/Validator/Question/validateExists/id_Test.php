<?php

class Question_Validator__validateExists__id__Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $question = new Question_Model();
        $question->id = 0;
        $question->title = 'How iPhone 8 are charged?';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        Question_Validator::validateExists($question);
    }

    public function testIDBelowZero()
    {
        $question = new Question_Model();
        $question->id = -1;
        $question->title = 'How iPhone 8 are charged?';
        $question->isRedirect = true;

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        Question_Validator::validateExists($question);
    }
}
