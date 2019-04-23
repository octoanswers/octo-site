<?php

class Model__Question__getHumanizedHashtags__Test extends PHPUnit\Framework\TestCase
{
    protected $question;

    public function setUp(): void
    {
        $this->question = new Question_Model;
    }

    public function tearDown(): void
    {
        $this->question = null;
    }

    public function test__zero_answers()
    {
        $this->question->setHashtags([]);
        // @NOTE Проверка корректно отрабатывает только при общем запуске тестов (почему-то)
        $this->assertEquals('Нет хештегов', $this->question->getHumanizedHashtags());
    }

    public function test__1_answer()
    {
        $this->question->setHashtags(["apple"]);
        // @NOTE Проверка корректно отрабатывает только при общем запуске тестов (почему-то)
        $this->assertEquals('1 хештег', $this->question->getHumanizedHashtags());
    }

    public function test__2_answers()
    {
        $this->question->setHashtags(["iphone8","apple"]);
        // @NOTE Проверка корректно отрабатывает только при общем запуске тестов (почему-то)
        $this->assertEquals('2 хештега', $this->question->getHumanizedHashtags());
    }
}
