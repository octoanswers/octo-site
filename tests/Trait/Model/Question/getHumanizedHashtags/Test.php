<?php

class Model__Question__getHumanizedHashtags__Test extends PHPUnit\Framework\TestCase
{
    protected $setUpDB = ['ru' => ['questions']];

    protected $question;

    public function setUp()
    {
        $this->question = new Question_Model;
        $this->question->answer = new Answer_Model();
    }

    public function tearDown()
    {
        $this->question = null;
    }

    public function test__zero_answers()
    {
        $this->question->answer->setText('');
        $this->assertEquals('Нет хештегов', $this->question->getHumanizedHashtags());
    }

    public function test__1_answer()
    {
        $this->question->answer->setText('Some Text');
        $this->assertEquals('1 хештег', $this->question->getHumanizedHashtags());
    }

    public function test__2_answers()
    {
        $this->question->answer->setText('Lorem ipsum dolor sit amet,');
        $this->assertEquals('2 хештега', $this->question->getHumanizedHashtags());
    }
}
