<?php

class Questions_URL_Helper__get_recently_updated_URL__Test extends PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = Questions_URL_Helper::get_recently_updated_URL('en');
        $this->assertEquals('https://answeropedia.org/en/questions/recently-updated', $url);
    }

    public function test_1()
    {
        $url = Questions_URL_Helper::get_recently_updated_URL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/questions/recently-updated', $url);
    }

    public function test_13()
    {
        $url = Questions_URL_Helper::get_recently_updated_URL('en', 2);
        $this->assertEquals('https://answeropedia.org/en/questions/recently-updated?page=2', $url);
    }
}
