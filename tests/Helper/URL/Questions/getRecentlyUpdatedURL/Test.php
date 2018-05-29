<?php

class Questions_URL_Helper__getRecentlyUpdatedURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = Questions_URL_Helper::getRecentlyUpdatedURL('en');
        $this->assertEquals('http://octoanswers.com/en/questions/recently-updated', $url);
    }

    public function test_1()
    {
        $url = Questions_URL_Helper::getRecentlyUpdatedURL('en', 1);
        $this->assertEquals('http://octoanswers.com/en/questions/recently-updated', $url);
    }

    public function test_13()
    {
        $url = Questions_URL_Helper::getRecentlyUpdatedURL('en', 2);
        $this->assertEquals('http://octoanswers.com/en/questions/recently-updated?page=2', $url);
    }
}
