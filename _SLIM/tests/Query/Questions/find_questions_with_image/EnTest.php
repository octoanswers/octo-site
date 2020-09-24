<?php

namespace Test\Query\Questions\findQuestionsWithImage;

class EnTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['en' => ['questions']];

    public function test__Find_without_params()
    {
        $questions = (new \Query\Questions('en'))->findQuestionsWithImage(29);

        $this->assertEquals(1, count($questions));

        $this->assertEquals(6, $questions[0]->id);
        $this->assertEquals('How birds are mark his territory?', $questions[0]->title);
        $this->assertEquals('4_2013_05_09_123', $questions[0]->imageBaseName);
    }
}
