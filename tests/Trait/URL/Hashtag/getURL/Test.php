<?php

class Trait_URL_Hashtag_getURLTest extends PHPUnit\Framework\TestCase
{
    public function test_URL_for_simple_hashtag()
    {
        $hashtag = new Hashtag;
        $hashtag->title = 'footag';

        $this->assertEquals('https://answeropedia.org/en/tag/footag', $hashtag->getURL('en'));
    }

    public function test_URL_for_hashtag_with_underscore()
    {
        $hashtag = new Hashtag;
        $hashtag->title = 'my_day';

        $this->assertEquals('https://answeropedia.org/en/tag/my_day', $hashtag->getURL('en'));
    }

    public function test_URL_for_RU_hashtag()
    {
        $hashtag = new Hashtag;
        $hashtag->title = 'дождь';

        $this->assertEquals('https://answeropedia.org/ru/tag/%D0%B4%D0%BE%D0%B6%D0%B4%D1%8C', $hashtag->getURL('ru'));
    }
}
