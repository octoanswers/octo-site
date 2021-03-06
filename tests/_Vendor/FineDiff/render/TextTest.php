<?php

namespace Test\Vendor\FineDiff\render;

use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    public function setUp(): void
    {
        $granularity = new \cogpowered\FineDiff\Granularity\Word();
        $this->diff = new \cogpowered\FineDiff\Diff($granularity);

        $this->render = new \cogpowered\FineDiff\Render\Text();
    }

    public function test__1_deletion()
    {
        $from_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';
        $to_text = 'К середине сентября была успешно завершена первая часть испытаний.';
        $opcodes = $this->diff->getOpcodes($from_text, $to_text);

        $rendered_diff = $this->render->process($from_text, $opcodes);

        $this->assertEquals('К середине сентября была успешно завершена первая часть испытаний.', $rendered_diff);
    }

    public function test__2_deletion()
    {
        $from_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';
        $to_text = 'К середине сентября была успешно завершена часть испытаний.';
        $opcodes = $this->diff->getOpcodes($from_text, $to_text);

        $rendered_diff = $this->render->process($from_text, $opcodes);

        $this->assertEquals('К середине сентября была успешно завершена часть испытаний.', $rendered_diff);
    }

    public function test__1_addition()
    {
        $from_text = 'К середине сентября была успешно завершена первая часть испытаний.';
        $to_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';
        $opcodes = $this->diff->getOpcodes($from_text, $to_text);

        $rendered_diff = $this->render->process($from_text, $opcodes);

        $this->assertEquals('К середине сентября 2008 года была успешно завершена первая часть испытаний.', $rendered_diff);
    }

    public function test__2_addition()
    {
        $from_text = 'К середине сентября была успешно завершена часть испытаний.';
        $to_text = 'К середине сентября 2008 года была успешно завершена первая часть испытаний.';
        $opcodes = $this->diff->getOpcodes($from_text, $to_text);

        $rendered_diff = $this->render->process($from_text, $opcodes);

        $this->assertEquals('К середине сентября 2008 года была успешно завершена первая часть испытаний.', $rendered_diff);
    }

    public function test__1_addition_and_1_deletion()
    {
        $from_text = 'К середине сентября 2008 года была успешно завершена часть испытаний.';
        $to_text = 'К середине сентября была успешно завершена первая часть испытаний.';
        $opcodes = $this->diff->getOpcodes($from_text, $to_text);

        $rendered_diff = $this->render->process($from_text, $opcodes);

        $this->assertEquals('К середине сентября была успешно завершена первая часть испытаний.', $rendered_diff);
    }
}
