<?php

class Question_Mapper__questionWithID_Base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__QuestionWithFullProperties()
    {
        $question = (new Question_Query('ru'))->questionWithID(6);

        $this->assertEquals(6, $question->getID());
        $this->assertEquals('Как птицы помечают свою территорию?', $question->getTitle());
        $this->assertEquals('["iPhone 8","Apple"]', $question->getTopicsJSON());
        $this->assertEquals(["iPhone 8","Apple"], $question->getTopics());
        $this->assertEquals('4_2013_05_09_123', $question->getImageBaseName());
    }

    public function test__NoTopics()
    {
        $question = (new Question_Query('ru'))->questionWithID(7);

        $this->assertEquals(7, $question->getID());
        $this->assertEquals('Какую роль играет почва во взаимосвязи неживой и живой природы?', $question->getTitle());
        $this->assertEquals(null, $question->getTopicsJSON());
        $this->assertEquals([], $question->getTopics());
    }
}
