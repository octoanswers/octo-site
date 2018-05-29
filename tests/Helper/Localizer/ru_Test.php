<?php

class Localizer_Helper__Test extends PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        $this->l = Localizer::getInstance('ru');
    }

    protected function tearDown()
    {
        $this->l = null;
    }

    public function test_FirstLevelKey()
    {
        $this->assertEquals('OctoAnswers', $this->l->t('octoanswers'));
    }

    public function test_FirstLevelKeyNotFound()
    {
        $this->assertEquals('MSG: not_found_message', $this->l->t('not_found_message'));
    }

    public function test_SecondLevelKey()
    {
        $this->assertEquals('Все авторы', $this->l->t('improve_answer', 'see_all'));
    }

    public function test_SecondLevelKeyNotFound()
    {
        $this->assertEquals('MSG: not_found - message', $this->l->t('not_found', 'message'));
    }

    public function test_SecondLevelKeyNotFound_2()
    {
        $this->assertEquals('MSG: foo - message', $this->l->t('foo', 'message'));
    }
}
