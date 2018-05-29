<?php

class Question_Validator__validateExists__id__Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $question = new Question_Model();
        $question->setID(0);
        $question->setTitle('How iPhone 8 are charged?');
        $question->setRedirect(true);

        $this->expectExceptionMessage('Question id param 0 must be greater than or equal to 1');
        Question_Validator::validateExists($question);
    }

    public function testIDBelowZero()
    {
        $question = new Question_Model();
        $question->setID(-1);
        $question->setTitle('How iPhone 8 are charged?');
        $question->setRedirect(true);

        $this->expectExceptionMessage('Question id param -1 must be greater than or equal to 1');
        Question_Validator::validateExists($question);
    }
}
