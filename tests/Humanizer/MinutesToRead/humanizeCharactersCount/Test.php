<?php

class MinutesToRead_Humanizer__humanizeCharactersCount__Test extends PHPUnit\Framework\TestCase
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
        $this->assertEquals('0 минут на чтение', $this->humanizer->humanizeCharactersCount(0));
    }

    public function test__1_answer()
    {
        $this->assertEquals('1 минута на чтение', $this->humanizer->humanizeCharactersCount(700));
    }

    public function test__2_answers()
    {
        $this->assertEquals('2 минуты на чтение', $this->humanizer->humanizeCharactersCount(1700));
    }

    public function test__negative_param()
    {
        $this->expectExceptionMessage('Count param -1 must be greater than or equal to 0');
        $this->humanizer->humanizeCharactersCount(-1);
    }
}
