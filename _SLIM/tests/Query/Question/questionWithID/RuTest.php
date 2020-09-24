<?php

namespace Test\Query\Question\questionWithID;

class RuTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['questions']];

    public function test__Question_with_full_properties()
    {
        $question = (new \Query\Question('ru'))->questionWithID(6);

        $this->assertEquals(6, $question->id);
        $this->assertEquals('Как птицы помечают свою территорию?', $question->title);
        $this->assertEquals('4_2013_05_09_123', $question->imageBaseName);
    }

    public function test__Question_with_no_categories()
    {
        $question = (new \Query\Question('ru'))->questionWithID(7);

        $this->assertEquals(7, $question->id);
        $this->assertEquals('Какую роль играет почва во взаимосвязи неживой и живой природы?', $question->title);
    }
}
