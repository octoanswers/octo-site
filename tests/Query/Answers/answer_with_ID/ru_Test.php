<?php

class Query_Answers__answer_with_ID__ruTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Question_with_answer()
    {
        $answer = (new \Query\Answers('ru'))->answer_with_ID(6);

        $this->assertEquals(6, $answer->id);
        $this->assertEquals('Птицы не помечают свою территорию.', $answer->text);
    }
}
