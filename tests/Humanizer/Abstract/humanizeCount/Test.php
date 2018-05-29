<?php

class Humanizer_humanizeCount__ru__Test extends PHPUnit\Framework\TestCase
{
    public $humanizer;

    public function setUp()
    {
        $loc = Localizer::getInstance('ru');
        $this->humanizer = new Abstract_Humanizer($loc);
    }

    public function tearDown()
    {
        $this->humanizer = null;
    }

    public function test_getAnswers_1()
    {
        $this->assertEquals('хомяк', $this->humanizer->humanizeCount(1, array('хомяк', 'хомяка', 'хомяков')));
    }

    public function test_getAnswers_2()
    {
        $this->assertEquals('хомяка', $this->humanizer->humanizeCount(2, array('хомяк', 'хомяка', 'хомяков')));
    }

    public function test_getAnswers_5()
    {
        $this->assertEquals('хомяков', $this->humanizer->humanizeCount(5, array('хомяк', 'хомяка', 'хомяков')));
    }

    public function test_getAnswers_131()
    {
        $this->assertEquals('хомяк', $this->humanizer->humanizeCount(131, array('хомяк', 'хомяка', 'хомяков')));
    }

    public function test_getAnswers_132()
    {
        $this->assertEquals('хомяка', $this->humanizer->humanizeCount(132, array('хомяк', 'хомяка', 'хомяков')));
    }

    public function test_getAnswers_137()
    {
        $this->assertEquals('хомяков', $this->humanizer->humanizeCount(137, array('хомяк', 'хомяка', 'хомяков')));
    }

    public function test_getAnswers_0()
    {
        $this->assertEquals('хомяков', $this->humanizer->humanizeCount(0, array('хомяк', 'хомяка', 'хомяков')));
    }
}
