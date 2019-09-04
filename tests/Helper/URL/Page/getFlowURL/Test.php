<?php

class Page_URL_Helper__get_flow_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test_en()
    {
        $this->assertEquals('https://answeropedia.org/en/flow', Page_URL_Helper::get_flow_URL('en'));
    }

    public function test_ru()
    {
        $this->assertEquals('https://answeropedia.org/ru/flow', Page_URL_Helper::get_flow_URL('ru'));
    }
}
