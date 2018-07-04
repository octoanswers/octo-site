<?php

class Question__getHumanizedMinutesToRead__Test extends PHPUnit\Framework\TestCase
{
    protected $question;

    public function setUp()
    {
        $this->question = new Question;
    }

    public function tearDown()
    {
        $this->question = null;
    }

    public function test__zero_answers()
    {
        $this->assertEquals('0 минут на чтение', $this->question->getHumanizedMinutesToRead(0));
    }

    public function test__1_answer()
    {
        $this->assertEquals('1 минута на чтение', $this->question->getHumanizedMinutesToRead(700));
    }

    public function test__2_answers()
    {
        $this->assertEquals('2 минуты на чтение', $this->question->getHumanizedMinutesToRead(1700));
    }
}
