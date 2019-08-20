<?php

use PHPUnit\Framework\TestCase;

class Differ__Test extends TestCase
{
    public function test__1_deletion()
    {
        $from_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';
        $to_text = 'К середине сентября была успешно завершена первая часть испытаний.';

        $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::$wordGranularity);
        //$to_text = FineDiff::renderToTextFromOpcodes($from_text, $opcodes);

        $this->assertEquals('c37d14c86', $opcodes);
    }

    public function test__2_deletion()
    {
        $from_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';
        $to_text = 'К середине сентября была успешно завершена часть испытаний.';

        $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::$wordGranularity);

        $this->assertEquals('c37d14c43d13c30', $opcodes);
    }

    public function test__1_addition()
    {
        $from_text = 'К середине сентября была успешно завершена первая часть испытаний.';
        $to_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';

        $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::$wordGranularity);
        //$to_text = FineDiff::renderToTextFromOpcodes($from_text, $opcodes);

        $this->assertEquals('c37i14:2008 года c86', $opcodes);
    }

    public function test__2_addition()
    {
        $from_text = 'К середине сентября была успешно завершена часть испытаний.';
        $to_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';

        $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::$wordGranularity);

        $this->assertEquals('c37i14:2008 года c43i13:первая c30', $opcodes);
    }

    public function test__1_addition_and_1_deletion()
    {
        $from_text = 'К середине сентября 2008 года была успешно завершена часть испытаний.';
        $to_text = 'К середине сентября была успешно завершена первая часть испытаний.';

        $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::$wordGranularity);

        $this->assertEquals('c37d14c43i13:первая c30', $opcodes);
    }

    // public function test__diff_long_text()
    // {
    //     $from_text = file_get_contents(dirname(__FILE__).'/txt/sample_from.txt');
    // 	$to_text = file_get_contents(dirname(__FILE__).'/txt/sample_to.txt');
    //
    //     $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::$wordGranularity);
    //
    //     $this->assertEquals("", $opcodes);
    // }
}
