<?php

class Query_Search_searchQuestions_Base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function testBase()
    {
        $questions = (new Search_Query('ru'))->searchQuestions('птицы');

        $this->assertEquals(5, count($questions));

        $questionOne = $questions[0];
        $this->assertEquals(6, $questionOne->getID());
        $this->assertEquals('Как птицы помечают свою территорию?', $questionOne->title);

        $questionTwo = $questions[1];
        $this->assertEquals(13, $questionTwo->getID());
        $this->assertEquals('Как птицы делают игры?', $questionTwo->title);

        $questionThree = $questions[2];
        $this->assertEquals(16, $questionThree->getID());
        $this->assertEquals('Как часто птицы поют песни?', $questionThree->title);

        $questionThree = $questions[4];
        $this->assertEquals(33, $questionThree->getID());
        $this->assertEquals('Птицы играют в игры?', $questionThree->title);
    }
}
