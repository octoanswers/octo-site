<?php

use PHPUnit\Framework\TestCase;

class Helper_ExtendedParsedown_text_hashtagsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->pd = new ExtendedParsedown('ru');
    }

    protected function tearDown(): void
    {
        $this->pd = null;
    }

    public function test_Link_to_hashtag()
    {
        $stringMD = "Any #birds may #fly.";
        $stringHTML = '<p>Any <a href="https://answeropedia.org/ru/tag/birds" title="#birds" class="inline-hashtag">#birds</a> may <a href="https://answeropedia.org/ru/tag/fly" title="#fly" class="inline-hashtag">#fly</a>.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }
}
