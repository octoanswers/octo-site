<?php

class Hashtag_URL_Trait__getURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $hashtag = new Hashtag;
        $hashtag->title = 'foo';
        $hashtag->id = 12;

        $this->assertEquals('https://answeropedia.org/en/hashtag/12/foo', $hashtag->getURL('en'));
    }

    public function test_ru()
    {
        $hashtag = new Hashtag;
        $hashtag->title = 'дождь';
        $hashtag->id = 34;

        $this->assertEquals('https://answeropedia.org/ru/hashtag/34/dozhd', $hashtag->getURL('ru'));
    }

    public function test_ru_WithUnderline()
    {
        $hashtag = new Hashtag;
        $hashtag->title = 'проливной_дождь';
        $hashtag->id = 56;

        $this->assertEquals('https://answeropedia.org/ru/hashtag/56/prolivnoi-dozhd', $hashtag->getURL('ru'));
    }
}
