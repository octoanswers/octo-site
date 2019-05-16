<?php

class Localizer_HelperTest extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        $this->translator = new Translator('ru', ROOT_PATH."/resources/lang");
    }

    protected function tearDown(): void
    {
        $this->translator = null;
    }

    public function test_Correct_key()
    {
        $this->assertEquals('Свежие правки', $this->translator->get('navbar', 'flow'));
    }

    public function test_Key_not_exists()
    {
        $this->assertEquals('MSG__ru__navbar__key_not_exists', $this->translator->get('navbar', 'key_not_exists'));
    }
}
