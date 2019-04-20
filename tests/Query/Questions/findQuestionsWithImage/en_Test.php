<?php

class Query_Questions__findQuestionsWithImage__en__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__En()
    {
        $questions = (new Questions_Query('en'))->findQuestionsWithImage(29);

        $this->assertEquals(1, count($questions));

        $this->assertEquals(6, $questions[0]->id);
        $this->assertEquals('How birds are mark his territory?', $questions[0]->title);
        $this->assertEquals('4_2013_05_09_123', $questions[0]->imageBaseName);
    }
}
