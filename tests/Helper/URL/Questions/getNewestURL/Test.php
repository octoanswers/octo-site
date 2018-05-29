<?php

class Questions_URL_Helper__getNewestURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = Questions_URL_Helper::getNewestURL('en');
        $this->assertEquals('http://octoanswers.com/en/questions/newest', $url);
    }

    public function test_1()
    {
        $url = Questions_URL_Helper::getNewestURL('en', 1);
        $this->assertEquals('http://octoanswers.com/en/questions/newest', $url);
    }

    public function test_13()
    {
        $url = Questions_URL_Helper::getNewestURL('en', 13);
        $this->assertEquals('http://octoanswers.com/en/questions/newest?page=13', $url);
    }
}
