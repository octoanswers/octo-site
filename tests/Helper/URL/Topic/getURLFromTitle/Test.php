<?php

class Topic_URL_Helper__getURLFromTitle__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://octoanswers.com/en/topic/gotofoo', Topic_URL_Helper::getURLFromTitle('en', 'gotofoo'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://octoanswers.com/ru/topic/дождь', Topic_URL_Helper::getURLFromTitle('ru', 'дождь'));
    }

    public function test_ru_WithUnderline()
    {
        $this->assertEquals('https://octoanswers.com/ru/topic/проливной__дождь', Topic_URL_Helper::getURLFromTitle('ru', 'проливной_дождь'));
    }
}
