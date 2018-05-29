<?php

class Question_Model__setTopicsJSON__Test extends PHPUnit\Framework\TestCase
{
    public function test__setTopicsJSON__Base()
    {
        $question = new Question_Model();
        $question->setTopicsJSON('["iPhone 8","Apple"]');

        $this->assertEquals('["iPhone 8","Apple"]', $question->getTopicsJSON());
        $this->assertEquals(["iPhone 8","Apple"], $question->getTopics());
    }

    public function test__setTopicsJSON__Empty()
    {
        $question = new Question_Model();
        $question->setTopicsJSON(null);

        $this->assertEquals(null, $question->getTopicsJSON());
        $this->assertEquals(null, $question->getTopics());
    }
}
