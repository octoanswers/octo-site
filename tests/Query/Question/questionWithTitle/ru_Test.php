<?php

class Mapper_Question_questionWithTitle_Base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__baseArgs()
    {
        $question = (new Question_Query('ru'))->questionWithTitle('Как птицы помечают свою территорию?');

        $this->assertEquals(6, $question->getID());
        $this->assertEquals('Как птицы помечают свою территорию?', $question->getTitle());
        $this->assertEquals('["iPhone 8","Apple"]', $question->getHashtagsJSON());
        $this->assertEquals(["iPhone 8","Apple"], $question->getHashtags());
        $this->assertEquals('4_2013_05_09_123', $question->getImageBaseName());
    }

    public function testQuestionWithoutAnswer()
    {
        $question = (new Question_Query('ru'))->questionWithTitle('В чем драматизм человека?');

        $this->assertEquals(5, $question->getID());
        $this->assertEquals('В чем драматизм человека?', $question->getTitle());
        $this->assertEquals('4_2066_05_09_123', $question->getImageBaseName());
    }
}
