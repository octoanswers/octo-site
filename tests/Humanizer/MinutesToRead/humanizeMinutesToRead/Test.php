<?php

class MinutesToRead_Humanizer__humanizeMinutesToRead__Test extends PHPUnit\Framework\TestCase
{
    public $humanizer;

    public function setUp()
    {
        $loc = Localizer::getInstance('ru');
        $this->humanizer = new MinutesToRead_Humanizer($loc);
    }

    public function tearDown()
    {
        $this->humanizer = null;
    }

    public function test__zero_answers()
    {
        $this->assertEquals('0 минут на чтение', $this->humanizer->humanizeMinutesToRead(0));
    }

    public function test__1_answer()
    {
        $this->assertEquals('1 минута на чтение', $this->humanizer->humanizeMinutesToRead(1));
    }

    public function test__2_answers()
    {
        $this->assertEquals('2 минуты на чтение', $this->humanizer->humanizeMinutesToRead(2));
    }

    public function test__5_answers()
    {
        $this->assertEquals('5 минут на чтение', $this->humanizer->humanizeMinutesToRead(5));
    }

    public function test__131_answers()
    {
        $this->assertEquals('131 минута на чтение', $this->humanizer->humanizeMinutesToRead(131));
    }

    public function test__132_answers()
    {
        $this->assertEquals('132 минуты на чтение', $this->humanizer->humanizeMinutesToRead(132));
    }

    public function test__137_answers()
    {
        $this->assertEquals('137 минут на чтение', $this->humanizer->humanizeMinutesToRead(137));
    }

    public function test__negative_param()
    {
        $this->expectExceptionMessage('Count param -1 must be greater than or equal to 0');
        $this->humanizer->humanizeMinutesToRead(-1);
    }
}
