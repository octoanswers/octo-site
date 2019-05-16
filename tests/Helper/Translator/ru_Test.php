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

    public function test_Simple_Key_not_exists()
    {
        $this->assertEquals('MSG__ru__key_not_exists', $this->translator->get('key_not_exists'));
    }

    public function test_Double_key()
    {
        $this->assertEquals('Свежие правки', $this->translator->get('navbar', 'flow'));
    }

    public function test_Double_Key_not_exists()
    {
        $this->assertEquals('MSG__ru__navbar__key_not_exists', $this->translator->get('navbar', 'key_not_exists'));
    }

    public function test_Triple_key()
    {
        $this->assertEquals('Вход', $this->translator->get('modal', 'login', 'title'));
    }

    public function test_Triple_key_not_exists()
    {
        $this->assertEquals('MSG__ru__modal__login__key_not_exists', $this->translator->get('modal', 'login', 'key_not_exists'));
    }
}
