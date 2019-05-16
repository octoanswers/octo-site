<?php

class Translator_EN_langTest extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        $this->translator = new Translator('en', ROOT_PATH."/resources/lang");
    }

    protected function tearDown(): void
    {
        $this->translator = null;
    }

    public function test_Simple_key()
    {
        $this->assertEquals('Answeropedia', $this->translator->get('answeropedia'));
    }

    public function test_Simple_Key_not_exists()
    {
        $this->assertEquals('MSG__en__key_not_exists', $this->translator->get('key_not_exists'));
    }

    public function test_Double_key()
    {
        $this->assertEquals('Flow', $this->translator->get('navbar', 'flow'));
    }

    public function test_Double_Key_not_exists()
    {
        $this->assertEquals('MSG__en__navbar__key_not_exists', $this->translator->get('navbar', 'key_not_exists'));
    }

    public function test_Triple_key()
    {
        $this->assertEquals('Login', $this->translator->get('modal', 'login', 'title'));
    }

    public function test_Triple_key_not_exists()
    {
        $this->assertEquals('MSG__en__modal__login__key_not_exists', $this->translator->get('modal', 'login', 'key_not_exists'));
    }
}
