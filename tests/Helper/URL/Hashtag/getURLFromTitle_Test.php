<?php

class Helper_URL_Hashtag_getURLFromTitleTest extends PHPUnit\Framework\TestCase
{
    public function test_URL_for_simple_hashtag()
    {
        $this->assertEquals('https://answeropedia.org/en/tag/footag', Hashtag_URL_Helper::getURLFromTitle('en', 'footag'));
    }

    public function test_URL_for_hashtag_with_underscore()
    {
        $this->assertEquals('https://answeropedia.org/en/tag/my_day', Hashtag_URL_Helper::getURLFromTitle('en', 'my_day'));
    }

    public function test_URL_for_RU_hashtag()
    {
        $this->assertEquals('https://answeropedia.org/ru/tag/%D0%B4%D0%BE%D0%B6%D0%B4%D1%8C', Hashtag_URL_Helper::getURLFromTitle('ru', 'дождь'));
    }
}
