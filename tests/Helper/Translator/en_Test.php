<?php

class Translator_English_Test extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        $this->translator = new Translator('en', ROOT_PATH."/resources/lang");
    }

    protected function tearDown(): void
    {
        $this->translator = null;
    }

    public function test_Correct_key()
    {
        $this->assertEquals('Flow', $this->translator->get('navbar', 'flow'));
    }

    public function test_Key_not_exists()
    {
        $this->assertEquals('MSG__en__question__title', $this->translator->get('question', 'title'));
    }
}
