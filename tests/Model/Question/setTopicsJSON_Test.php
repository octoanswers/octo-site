<?php

class Question_Model__setTopicsJSON__Test extends PHPUnit\Framework\TestCase
{
    public function test__Base()
    {
        $question = new Question_Model();
        $question->setTopicsJSON('["iPhone 8","Apple"]');

        $this->assertEquals('["iPhone 8","Apple"]', $question->getTopicsJSON());
        $this->assertEquals(["iPhone 8","Apple"], $question->getTopics());
    }

    public function test__Empty()
    {
        $this->expectExceptionMessage('Topics JSON must be longer than 0 char');

        $question = new Question_Model();
        $question->setTopicsJSON('');
    }
}
