<?php

class ColorMixer_Helper__Test extends PHPUnit\Framework\TestCase
{
    public function test_half()
    {
        $this->assertEquals('7f7f7f', ColorMixer_Helper::colorBetween('ffffff', '000000', 0.5));
    }

    public function test_light()
    {
        $this->assertEquals('e5e5e5', ColorMixer_Helper::colorBetween('ffffff', '000000', 0.1));
    }

    public function test_dark()
    {
        $this->assertEquals('191919', ColorMixer_Helper::colorBetween('ffffff', '000000', 0.9));
    }
}
