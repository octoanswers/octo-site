<?php

class Page_URL_Helper__getFlowURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('http://octoanswers.com/en/flow', Page_URL_Helper::getFlowURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('http://octoanswers.com/ru/flow', Page_URL_Helper::getFlowURL('ru'));
    }
}
