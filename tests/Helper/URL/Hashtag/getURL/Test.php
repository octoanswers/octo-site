<?php

class Topic_URL_Helper__getURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $topic = Topic_Model::initWithTitle('gotofoo');

        $this->assertEquals('http://octoanswers.com/en/topic/gotofoo', Topic_URL_Helper::getURL('en', $topic));
    }

    public function test_ru()
    {
        $topic = Topic_Model::initWithTitle('дождь');

        $this->assertEquals('http://octoanswers.com/ru/topic/дождь', Topic_URL_Helper::getURL('ru', $topic));
    }

    public function test_ru_WithUnderline()
    {
        $topic = Topic_Model::initWithTitle('проливной_дождь');

        $this->assertEquals('http://octoanswers.com/ru/topic/проливной__дождь', Topic_URL_Helper::getURL('ru', $topic));
    }
}
