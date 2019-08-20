<?php

use PHPUnit\Framework\TestCase;

class FineDiff__renderToTextFromOpcodes__Test extends TestCase
{
    public function test__1_deletion()
    {
        $from_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';
        $to_text = 'К середине сентября была успешно завершена первая часть испытаний.';
        $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::wordDelimiters);

        $rendered_diff = FineDiff::renderToTextFromOpcodes($from_text, $opcodes);

        $this->assertEquals('К середине сентября была успешно завершена первая часть испытаний.', $rendered_diff);
    }

    public function test__2_deletion()
    {
        $from_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';
        $to_text = 'К середине сентября была успешно завершена часть испытаний.';
        $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::$wordGranularity);

        $rendered_diff = FineDiff::renderToTextFromOpcodes($from_text, $opcodes);

        $this->assertEquals('К середине сентября была успешно завершена часть испытаний.', $rendered_diff);
    }

    public function test__1_addition()
    {
        $from_text = 'К середине сентября была успешно завершена первая часть испытаний.';
        $to_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';
        $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::$wordGranularity);

        $rendered_diff = FineDiff::renderToTextFromOpcodes($from_text, $opcodes);

        $this->assertEquals('К середине сентября 2008 года была успешно завершена первая часть испытаний.', $rendered_diff);
    }

    public function test__2_addition()
    {
        $from_text = 'К середине сентября была успешно завершена часть испытаний.';
        $to_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';
        $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::$wordGranularity);

        $rendered_diff = FineDiff::renderToTextFromOpcodes($from_text, $opcodes);

        $this->assertEquals('К середине сентября 2008 года была успешно завершена первая часть испытаний.', $rendered_diff);
    }

    public function test__1_addition_and_1_deletion()
    {
        $from_text = 'К середине сентября 2008 года была успешно завершена часть испытаний.';
        $to_text = 'К середине сентября была успешно завершена первая часть испытаний.';
        $opcodes = FineDiff::getDiffOpcodes($from_text, $to_text, FineDiff::$wordGranularity);

        $rendered_diff = FineDiff::renderToTextFromOpcodes($from_text, $opcodes);

        $this->assertEquals('К середине сентября была успешно завершена первая часть испытаний.', $rendered_diff);
    }
}
