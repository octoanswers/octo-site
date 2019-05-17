<?php

class TranslatorTest extends PHPUnit\Framework\TestCase
{
    public function test_Lang_file_not_exists()
    {
        $this->expectExceptionMessage('File with translated messages "foo.json" not exists');
        $this->translator = new Translator('foo', ROOT_PATH."/app/Lang");
    }

    public function test_Key_point_to_array()
    {
        $this->translator = new Translator('ru', ROOT_PATH."/app/Lang");
        $this->assertEquals('KEY_IS_ARRAY: language "ru" key "test_key"', $this->translator->get('test_key'));
    }

    public function test_Subkey_point_to_array()
    {
        $this->translator = new Translator('ru', ROOT_PATH."/app/Lang");
        $this->assertEquals('KEY_IS_ARRAY: language "ru" key "test_key" subkey "subkey_as_array"', $this->translator->get('test_key', 'subkey_as_array'));
    }
}
