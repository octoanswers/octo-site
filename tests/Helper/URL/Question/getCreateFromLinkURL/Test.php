<?php

class Question_URL_Helper__getCreateFromLinkURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_baseURI()
    {
        $url = Question_URL_Helper::getCreateFromLinkURL('en', 'How iPhone 8 are charged?');
        $this->assertEquals('http://octoanswers.com/en/question/create/How_iPhone_8_are_charged', $url);
    }

    public function test_RuTitle()
    {
        $url = Question_URL_Helper::getCreateFromLinkURL('ru', 'Можно ли сохранить массив в COOKIE?');
        $this->assertEquals('http://octoanswers.com/ru/question/create/Можно_ли_сохранить_массив_в_COOKIE', $url);
    }
}
