<?php

class Translator_RU_langTest extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        $this->translator = new Translator('ru', ROOT_PATH."/app/Lang");
    }

    protected function tearDown(): void
    {
        $this->translator = null;
    }

    public function test_Simple_key()
    {
        $this->assertEquals('Ансверопедия', $this->translator->get('answeropedia'));
    }

    public function test_Simple_key_not_exists_return_as_key()
    {
        $this->assertEquals('Key not exists', $this->translator->get('Key not exists'));
    }

    public function test_Double_key()
    {
        $this->assertEquals('Свежие правки', $this->translator->get('navbar', 'flow'));
    }

    public function test_Double_Key_not_exists()
    {
        $this->assertEquals('NEED TRANSLATE: language "ru" key "navbar" subkey "key_not_exists"', $this->translator->get('navbar', 'key_not_exists'));
    }
}
