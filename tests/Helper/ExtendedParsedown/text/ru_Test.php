<?php

use PHPUnit\Framework\TestCase;

class ExtendedParsedown__text__ru_Test extends TestCase
{
    protected function setUp()
    {
        $this->pd = new ExtendedParsedown('ru');
    }

    protected function tearDown()
    {
        $this->pd = null;
    }

    public function test__InlineTopic()
    {
        $stringMD = "text #tag text";
        $stringHTML = "<p>text <a href=\"http://octoanswers.com/ru/topic/tag\" class=\"topic\">#tag</a> text</p>";

        $this->assertEquals($stringHTML, $this->pd->text($stringMD));
    }

    public function test__H2()
    {
        $stringMD = "# Head\ntext";
        $stringHTML = "<h2>Head</h2>\n<p>text</p>";

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
