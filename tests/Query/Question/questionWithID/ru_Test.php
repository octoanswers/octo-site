<?php

class Question_Mapper__question_with_ID_Base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__QuestionWithFullProperties()
    {
        $question = (new Question_Query('ru'))->question_with_ID(6);

        $this->assertEquals(6, $question->id);
        $this->assertEquals('Как птицы помечают свою территорию?', $question->title);
        $this->assertEquals('4_2013_05_09_123', $question->imageBaseName);
    }

    public function test__NoCategories()
    {
        $question = (new Question_Query('ru'))->question_with_ID(7);

        $this->assertEquals(7, $question->id);
        $this->assertEquals('Какую роль играет почва во взаимосвязи неживой и живой природы?', $question->title);
    }
}
