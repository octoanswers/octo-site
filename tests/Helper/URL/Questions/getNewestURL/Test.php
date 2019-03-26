<?php

class Questions_URL_Helper__getNewestURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = Questions_URL_Helper::getNewestURL('en');
        $this->assertEquals('https://answeropedia.org/en/questions/newest', $url);
    }

    public function test_1()
    {
        $url = Questions_URL_Helper::getNewestURL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/questions/newest', $url);
    }

    public function test_13()
    {
        $url = Questions_URL_Helper::getNewestURL('en', 13);
        $this->assertEquals('https://answeropedia.org/en/questions/newest?page=13', $url);
    }
}
