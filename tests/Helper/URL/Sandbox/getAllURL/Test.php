<?php

class Sandbox_URL_Helper__getAllURL__Test extends PHPUnit\Framework\TestCase
{
    public function test_withoutPage()
    {
        $url = Sandbox_URL_Helper::getAllURL('ru');
        $this->assertEquals('https://answeropedia.org/ru/sandbox/all', $url);
    }

    public function test_ru_1()
    {
        $url = Sandbox_URL_Helper::getAllURL('ru', 1);
        $this->assertEquals('https://answeropedia.org/ru/sandbox/all', $url);
    }

    public function test_en_1()
    {
        $url = Sandbox_URL_Helper::getAllURL('en', 1);
        $this->assertEquals('https://answeropedia.org/en/sandbox/all', $url);
    }

    public function test_13()
    {
        $url = Sandbox_URL_Helper::getAllURL('en', 13);
        $this->assertEquals('https://answeropedia.org/en/sandbox/all?page=13', $url);
    }
}
