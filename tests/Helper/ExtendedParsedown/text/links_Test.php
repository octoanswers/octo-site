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

    public function test__normal_link_to_octoanswers()
    {
        $stringMD = "Это текст о [каше](https://answeropedia.org/ru/123/chto-takoe-kasha) и молоке.";
        $stringHTML = "<p>Это текст о <a href=\"https://answeropedia.org/ru/123/chto-takoe-kasha\">каше</a> и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__external_link()
    {
        $stringMD = "Это текст о [каше](http://site.com/page) и молоке.";
        $stringHTML = "<p>Это текст о <a href=\"http://site.com/page\" class=\"link-external\" target=\"_blank\" rel=\"nofollow\">каше</a> и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__normal_and_external_links()
    {
        $stringMD = "Это текст о [каше](https://answeropedia.org/ru/123/chto-takoe-kasha) и [молоке](http://site.com/page).";
        $stringHTML = "<p>Это текст о <a href=\"https://answeropedia.org/ru/123/chto-takoe-kasha\">каше</a> и <a href=\"http://site.com/page\" class=\"link-external\" target=\"_blank\" rel=\"nofollow\">молоке</a>.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__external_https_link()
    {
        $stringMD = "Это текст о [каше](https://site.com/page) и молоке.";
        $stringHTML = "<p>Это текст о <a href=\"https://site.com/page\" class=\"link-external\" target=\"_blank\" rel=\"nofollow\">каше</a> и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__old_style_link()
    {
        $stringMD = "Это текст о [каше](Что такое каша?) и молоке.";
        $stringHTML = "<p>Это текст о [каше](Что такое каша?) и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__incorrect_link_without_reference_part()
    {
        $stringMD = "Это текст о [каше] и молоке.";
        $stringHTML = "<p>Это текст о [каше] и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__incorrect_link_with_empty_reference_part()
    {
        $stringMD = "Это текст о [каше]() и молоке.";
        $stringHTML = "<p>Это текст о [каше]() и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

}
