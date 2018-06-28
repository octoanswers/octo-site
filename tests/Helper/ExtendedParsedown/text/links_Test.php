<?php

use PHPUnit\Framework\TestCase;

class ExtendedParsedown__links__ru_Test extends TestCase
{
    protected function setUp()
    {
        $this->pd = new ExtendedParsedown('ru');
    }

    protected function tearDown()
    {
        $this->pd = null;
    }

    public function test__DontLinkHashtags()
    {
        $stringMD = "Это текст о [каше]() и молоке.";
        $stringHTML = "<p>Это текст о <a href=\"https:\/\/octoanswers.com/ru/каше\">каше<\/a> и молоке.<\/p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__H2()
    {
        $stringMD = "Это текст о [каше](Что такое каша?) и молоке.";
        $stringHTML = "<p>Это текст о <a href=\"https:\/\/octoanswers.com/ru/Что_такое_каша\">каше<\/a> и молоке.<\/p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__H3()
    {
        $stringMD = "Это текст о [каше](https://octoanswers.com/ru/123/chto-takoe-kasha) и молоке.";
        $stringHTML = "<p>Это текст о <a href=\"https://octoanswers.com/ru/123/chto-takoe-kasha\">каше</a> и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__external_link()
    {
        $stringMD = "Это текст о [каше](https://site.com/page) и молоке.";
        $stringHTML = "<p>Это текст о <a href=\"https://site.com/page\" class=\"external-link\" target=\"_blank\" rel=\"nofollow\">каше</a> и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

}
