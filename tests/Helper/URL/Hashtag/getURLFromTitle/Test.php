<?php

class Hashtag_URL_Helper__getURLFromTitle__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/hashtag/gotofoo', Hashtag_URL_Helper::getURLFromTitle('en', 'gotofoo'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/hashtag/дождь', Hashtag_URL_Helper::getURLFromTitle('ru', 'дождь'));
    }

    public function test_ru_WithUnderline()
    {
        $this->assertEquals('https://answeropedia.org/ru/hashtag/проливной__дождь', Hashtag_URL_Helper::getURLFromTitle('ru', 'проливной_дождь'));
    }
}
