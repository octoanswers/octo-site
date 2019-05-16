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

    public function test_Simple_key()
    {
        $this->assertEquals('Перевод заголовка', $this->translator->get('title'));
    }

    public function test_Simple_key_not_exists()
    {
        $this->assertEquals('MSG_ru_key_not_exists', $this->translator->get('key_not_exists'));
    }

    public function test_Double_key()
    {
        $this->assertEquals('Вопросы', $this->translator->get('navbar', 'questions'));
    }

    public function test_Double_key_not_exists()
    {
        $this->assertEquals('MSG_question_title', $this->translator->get('question', 'title'));
    }
}
