<?php

class Query_Answers_answer_with_ID_base_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function testQuestionWithAnswer()
    {
        $answer = (new Answers_Query('ru'))->answer_with_ID(6);

        $this->assertEquals(6, $answer->id);
        $this->assertEquals('Птицы не помечают свою территорию.', $answer->text);
    }
}
