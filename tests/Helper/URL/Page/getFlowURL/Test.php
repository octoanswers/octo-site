<?php

class Page_URL_Helper__getFlowURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/flow', Page_URL_Helper::getFlowURL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/flow', Page_URL_Helper::getFlowURL('ru'));
    }
}
