<?php

namespace Test\Query\Answers\answer_with_ID;

class RuTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Question_with_answer()
    {
        $answer = (new \Query\Answers('ru'))->answer_with_ID(6);

        $this->assertEquals(6, $answer->id);
        $this->assertEquals('Птицы не помечают свою территорию.', $answer->text);
    }
}
