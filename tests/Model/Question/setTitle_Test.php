<?php

class Model_Question_setTitle_Test extends PHPUnit\Framework\TestCase
{
    public function test_TitleWithQuestionMark()
    {
        $question = new Question_Model();
        $question->setTitle('How iPhone 8 are charged?');

        $this->assertEquals('How iPhone 8 are charged?', $question->getTitle());
    }

    public function test_TitleWithoutQuestionMark()
    {
        $question = new Question_Model();
        $question->setTitle('How iPhone 8 are charged');

        $this->assertEquals('How iPhone 8 are charged', $question->getTitle());
    }
}
