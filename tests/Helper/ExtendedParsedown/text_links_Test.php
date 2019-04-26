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
        $stringMD = "I eat [crisp](What is crisp?) every day.";
        $stringHTML = '<p>I eat <a href="https://answeropedia.org/ru/What_is_crisp" title="What is crisp?">crisp</a> every day.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_Double_Markdown_style_link()
    {
        $stringMD = "[Steve](Steve Jobs) and [iPhone 8](iPhone 8) together.";
        $stringHTML = '<p><a href="https://answeropedia.org/ru/Steve_Jobs" title="Steve Jobs">Steve</a> and <a href="https://answeropedia.org/ru/iPhone_8" title="iPhone 8">iPhone 8</a> together.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    // public function test_Link_without_reference_part()
    // {
    //     $stringMD = "Это текст о [каше] и молоке.";
    //     $stringHTML = '<p>Это текст о <a href="https://answeropedia.org/ru/%D0%BA%D0%B0%D1%88%D0%B5" title="XXXкаше">каше</a> и молоке.</p>';

    //     $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    // }

    // public function test_Link_with_empty_reference_part()
    // {
    //     $stringMD = "Это текст о [каше]() и молоке.";
    //     $stringHTML = '<p>Это текст о <a href="https://answeropedia.org/ru/%D0%BA%D0%B0%D1%88%D0%B5" title="XXXкаше">каше</a> и молоке.</p>';

    //     $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    // }
    
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
        $stringMD = "Это текст о [каше](https://site.com/foo-page) и молоке.";
        $stringHTML = '<p>Это текст о <a href="https://site.com/foo-page" class="link-external" target="_blank" rel="nofollow">каше</a> и молоке.</p>';

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test_Direct_and_external_links_in_one_paragraph()
    {
        $stringMD = "Это текст о [каше](https://answeropedia.org/ru/123/chto-takoe-kasha) и [молоке](http://site.com/page).";
        $stringHTML = "<p>Это текст о <a href=\"https://answeropedia.org/ru/123/chto-takoe-kasha\">каше</a> и <a href=\"http://site.com/page\" class=\"link-external\" target=\"_blank\" rel=\"nofollow\">молоке</a>.</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }
}
