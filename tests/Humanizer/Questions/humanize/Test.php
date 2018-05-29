<?php

class Questions_Humanizer__humanize__Test extends PHPUnit\Framework\TestCase
{
    public $humanizer;

    public function setUp()
    {
        $loc = Localizer::getInstance('ru');
        $this->humanizer = new Questions_Humanizer($loc);
    }

    public function tearDown()
    {
        $this->humanizer = null;
    }

    public function test__zero_answers()
    {
        $this->assertEquals('Нет вопросов', $this->humanizer->humanize(0));
    }

    public function test__1_answer()
    {
        $this->assertEquals('1 вопрос', $this->humanizer->humanize(1));
    }

    public function test__2_answers()
    {
        $this->assertEquals('2 вопроса', $this->humanizer->humanize(2));
    }

    public function test__5_answers()
    {
        $this->assertEquals('5 вопросов', $this->humanizer->humanize(5));
    }

    public function test__131_answers()
    {
        $this->assertEquals('131 вопрос', $this->humanizer->humanize(131));
    }

    public function test__132_answers()
    {
        $this->assertEquals('132 вопроса', $this->humanizer->humanize(132));
    }

    public function test__137_answers()
    {
        $this->assertEquals('137 вопросов', $this->humanizer->humanize(137));
    }

    public function test__negative_param()
    {
        $this->expectExceptionMessage('Count param -1 must be greater than or equal to 0');
        $this->humanizer->humanize(-1);
    }
}
