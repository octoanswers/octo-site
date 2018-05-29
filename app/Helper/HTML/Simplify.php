<?php

class Simplify_HTML_Helper
{
    #
    # Public extractors
    #

    public static function extractSignificantContentFromHTMLString(string $HTMLString): string
    {
        if (strlen($HTMLString) == 0) {
            return '';
        }

        $divs = self::splitStringToDivs($HTMLString);
        $divs = self::clearDivs($divs);

        $mathAverage = self::calculateMathAverage($divs);

        $divs = self::getDivsAfterMathAverage($divs, $mathAverage);

        return implode("\n\n", $divs);
    }

    #
    # Private methods
    #

    private static function splitStringToDivs(string $string): array
    {
        return preg_split("/<div[^>]*>/iu", $string);
    }

    private static function clearDivs(array $divs): array
    {
        $clearedDivs = [];
        foreach ($divs as &$divHtml) {
            // remove div-tags ending (</div>)
            $divHtml = preg_replace("/<\/div>/i", '', $divHtml);
            $divHtml = trim($divHtml);

            $html2Text = new \Html2Text\Html2Text($divHtml);
            $text = $html2Text->getText();
            $clearText = self::clearText($text);

            // remember only not empty div`s
            if (strlen($clearText) > 0) {
                $clearedDivs[] = $clearText;
            }
        }
        return $clearedDivs;
    }

    private static function calculateMathAverage(array $divs): int
    {
        $elementsSum = 0;
        $elementsCount = count($divs);

        if ($elementsCount == 0) {
            return 0;
        }

        foreach ($divs as &$div) {
            $elementsSum = $elementsSum + strlen($div);
        }

        return intval($elementsSum/$elementsCount);
    }

    private static function getDivsAfterMathAverage(array $divs, int $mathAverage): array
    {
        $divsAfterMathAverage = [];

        foreach ($divs as &$div) {
            if (strlen($div) > $mathAverage) {
                $divsAfterMathAverage[] = $div;
            }
        }

        return $divsAfterMathAverage;
    }

    private static function clearText($text)
    {
        // replace multiple spaces with a single space
        $text = preg_replace("/[ \t]{2,}/iu", '', $text);

        // replace multiple (3 or more) linebreaks
        $text = preg_replace("/[\n]{3,}/iu", "\n\n", $text);
        $text = preg_replace("/[\r]{3,}/iu", "\r\r", $text);

        // delete scripts (not contain RU-letters)
        if (self::countEnLetters($text) > self::countRuLetters($text)) {
            $text = '';
        }

        $text = trim($text);
        return $text;
    }

    private static function countEnLetters($str)
    {
        return preg_match_all("/[a-zA-Z]/", $str);
    }

    private static function countRuLetters($str)
    {
        return preg_match_all("/[а-яА-Я]/", $str);
    }
}
