<?php

class Helper_KeyWordExtractor_Test extends PHPUnit\Framework\TestCase
{
    public function test_keyWordsFromTitle()
    {
        $this->assertEquals('поменять код домофонах', KeyWordExtractor::extractFromTitle('Как поменять код в домофонах?'));
    }

    public function test_keyWordsFromTitle_2()
    {
        $this->assertEquals('работу выбрать', KeyWordExtractor::extractFromTitle('Какую работу выбрать?'));
    }

    public function test_keyWordsFromTitle_3()
    {
        $this->assertEquals('виды теплых полов бывают', KeyWordExtractor::extractFromTitle('Какие виды теплых полов бывают?'));
    }

    public function test_keyWordsFromTitle_punctuationMarks()
    {
        $this->assertEquals('ближайшее время усть качке поедет путин', KeyWordExtractor::extractFromTitle('Когда, в ближайшее время, по Усть-Качке поедет Путин?'));
    }

    public function test_keyWordsFromTitle_enWord()
    {
        $this->assertEquals('нaстроить dns iphone', KeyWordExtractor::extractFromTitle('Как нaстроить dns в iphone?'));
    }

    public function test_keyWordsFromTitle_unstemmedWord()
    {
        $this->assertEquals('пишут хабрахабре', KeyWordExtractor::extractFromTitle('О чем пишут на хабрахабре?'));
    }

    public function test_keyWordsFromTitle_emptyParam()
    {
        $this->assertEquals('', KeyWordExtractor::extractFromTitle(''));
    }
}
