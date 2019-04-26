<?php

use PHPUnit\Framework\TestCase;

class Helper_ExtendedParsedown_text_linksTest extends TestCase
{
    protected function setUp(): void
    {
        $this->pd = new ExtendedParsedown('ru');
    }

    protected function tearDown(): void
    {
        $this->pd = null;
    }

    public function test_Markdown_style_link()
    {
        $stringMD = "Это текст о [каше](Что такое каша?) и молоке.";
        $stringHTML = "<p>Это текст о [каше](Что такое каша?) и молоке.</p>";
//        $stringHTML = '<p>Это текст о <a href="https://answeropedia.org/ru/%D0%A7%D1%82%D0%BE_%D1%82%D0%B0%D0%BA%D0%BE%D0%B5_%D0%BA%D0%B0%D1%88%D0%B0" title="Что такое каша?">каше</a> и молоке.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_Link_without_reference_part()
    {
        $stringMD = "Это текст о [каше] и молоке.";
        $stringHTML = "<p>Это текст о [каше] и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_Link_with_empty_reference_part()
    {
        $stringMD = "Это текст о [каше]() и молоке.";
        $stringHTML = '<p>Это текст о <a href="https://answeropedia.org/ru/%D0%BA%D0%B0%D1%88%D0%B5" title="каше">каше</a> и молоке.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }
    
    public function test_Direct_link_to_Answeropedia()
    {
        $stringMD = "Это текст о [каше](https://answeropedia.org/ru/123/chto-takoe-kasha) и молоке.";
        $stringHTML = "<p>Это текст о <a href=\"https://answeropedia.org/ru/123/chto-takoe-kasha\">каше</a> и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_External_HTTP_link()
    {
        $stringMD = "Это текст о [каше](http://site.com/page) и молоке.";
        $stringHTML = "<p>Это текст о <a href=\"http://site.com/page\" class=\"link-external\" target=\"_blank\" rel=\"nofollow\">каше</a> и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_External_HTTPS_link()
    {
        $stringMD = "Это текст о [каше](https://site.com/page) и молоке.";
        $stringHTML = "<p>Это текст о <a href=\"https://site.com/page\" class=\"link-external\" target=\"_blank\" rel=\"nofollow\">каше</a> и молоке.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_Direct_and_external_links_in_one_paragraph()
    {
        $stringMD = "Это текст о [каше](https://answeropedia.org/ru/123/chto-takoe-kasha) и [молоке](http://site.com/page).";
        $stringHTML = "<p>Это текст о <a href=\"https://answeropedia.org/ru/123/chto-takoe-kasha\">каше</a> и <a href=\"http://site.com/page\" class=\"link-external\" target=\"_blank\" rel=\"nofollow\">молоке</a>.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }
}
