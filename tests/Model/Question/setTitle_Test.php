<?php

class Model_Question_Title_Test extends PHPUnit\Framework\TestCase
{
    public function test_TitleWithQuestionMark()
    {
        $question = new Question_Model();
        $question->title = 'How iPhone 8 are charged?';

        $this->assertEquals('How iPhone 8 are charged?', $question->title);
    }

    public function test_TitleWithoutQuestionMark()
    {
        $question = new Question_Model();
        $question->title = 'How iPhone 8 are charged';

        $this->assertEquals('How iPhone 8 are charged', $question->title);
    }
}
