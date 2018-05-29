<?php

use PHPUnit\Framework\TestCase;

class Helper_Simplify_HTML_Helper_extractSignificantContentFromHTMLString_base_Test extends TestCase
{
    public function test_HTMLStringWithTwoDivs_MainContentExtracted()
    {
        $HTMLString = '<head>xxx</head><body><div>Короткий div</div><div>Div содержащий основной контент</div></body>';
        $extractedContent = Simplify_HTML_Helper::extractSignificantContentFromHTMLString($HTMLString);

        $this->assertEquals('Div содержащий основной контент', $extractedContent);
    }

    public function test_HTMLStringWithThreeDivs_ReturnOneDiv()
    {
        $HTMLString = '<head>xxx</head><body><div>Короткий div1</div><div>Div содержащий основной контент</div><div>Короткий div2</div></body>';
        $extractedContent = Simplify_HTML_Helper::extractSignificantContentFromHTMLString($HTMLString);

        $this->assertEquals('Div содержащий основной контент', $extractedContent);
    }

    public function test_HTMLStringWithThreeDivs_ReturnTwoDivs()
    {
        $HTMLString = '<head>xxx</head><body><div>Короткий div</div><div>Div1 содержащий основной контент</div><div>Div2 содержащий основной контент</div></body>';
        $extractedContent = Simplify_HTML_Helper::extractSignificantContentFromHTMLString($HTMLString);

        $this->assertEquals("Div1 содержащий основной контент\n\nDiv2 содержащий основной контент", $extractedContent);
    }

    public function test_EmptyHTMLString_MainContentExtracted()
    {
        $HTMLString = '';
        $mainContent = Simplify_HTML_Helper::extractSignificantContentFromHTMLString($HTMLString);

        $this->assertEquals('', $mainContent);
    }
}
