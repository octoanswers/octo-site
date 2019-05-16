<?php

class TranslatorTest extends PHPUnit\Framework\TestCase
{
    public function test_Lang_file_not_exists()
    {
        $this->expectExceptionMessage('File with translated messages "foo.json" not exists');
        $this->translator = new Translator('foo', ROOT_PATH."/resources/lang");
    }
}
