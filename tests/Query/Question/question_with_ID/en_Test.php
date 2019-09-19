<?php

class Query_Question__question_with_ID__enTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Question_with_answer()
    {
        $question = (new \Query\Question('en'))->question_with_ID(6);

        $this->assertEquals(6, $question->id);
        $this->assertEquals('How birds are mark his territory?', $question->title);
        $this->assertEquals('4_2013_05_09_123', $question->imageBaseName);
    }
}
