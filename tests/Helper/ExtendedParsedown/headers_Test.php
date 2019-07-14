<?php

use PHPUnit\Framework\TestCase;

class Helper_ExtendedParsedown_text_headersTest extends TestCase
{
    protected function setUp(): void
    {
        $this->pd = new ExtendedParsedown('ru');
    }

    protected function tearDown(): void
    {
        $this->pd = null;
    }

    public function test__H2()
    {
        $stringMD = "# Header\nText";
        $stringHTML = "<h2>Header</h2>\n<p>Text</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__H3()
    {
        $stringMD = "## Head\ntext";
        $stringHTML = "<h3>Head</h3>\n<p>text</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__H4()
    {
        $stringMD = "### Head\ntext";
        $stringHTML = "<h4>Head</h4>\n<p>text</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__H5()
    {
        $stringMD = "#### Head\ntext";
        $stringHTML = "<h5>Head</h5>\n<p>text</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__H6()
    {
        $stringMD = "##### Head\ntext";
        $stringHTML = "<h6>Head</h6>\n<p>text</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__MoreThanH6()
    {
        $stringMD = "###### Head\ntext";
        $stringHTML = "<p>###### Head\ntext</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }
}
