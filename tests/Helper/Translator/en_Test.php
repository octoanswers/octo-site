<?php

class Translator_EN_langTest extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        $this->translator = new Translator('en', ROOT_PATH."/app/Lang");
    }

    protected function tearDown(): void
    {
        $this->translator = null;
    }

    public function test_Simple_key()
    {
        $this->assertEquals('Answeropedia', $this->translator->get('answeropedia'));
    }

    public function test_Simple_key_not_exists_return_as_key()
    {
        $this->assertEquals('Key not exists', $this->translator->get('Key not exists'));
    }

    public function test_Double_key()
    {
        $this->assertEquals('Flow', $this->translator->get('navbar', 'flow'));
    }

    public function test_Double_key_not_exists()
    {
        $this->assertEquals('NEED TRANSLATE (en) navbar - key_not_exists', $this->translator->get('navbar', 'key_not_exists'));
    }
}
