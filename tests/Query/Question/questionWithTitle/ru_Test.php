<?php

class Mapper_Question_questionWithTitle_Base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__baseArgs()
    {
        $question = (new Question_Query('ru'))->questionWithTitle('Как птицы помечают свою территорию?');

        $this->assertEquals(6, $question->id);
        $this->assertEquals('Как птицы помечают свою территорию?', $question->title);
        $this->assertEquals(2, count($question->getCategories()));
        $this->assertEquals('4_2013_05_09_123', $question->imageBaseName);
    }

    public function testQuestionWithoutAnswer()
    {
        $question = (new Question_Query('ru'))->questionWithTitle('В чем драматизм человека?');

        $this->assertEquals(5, $question->id);
        $this->assertEquals('В чем драматизм человека?', $question->title);
        $this->assertEquals('4_2066_05_09_123', $question->imageBaseName);
    }
}
