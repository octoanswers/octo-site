<?php

class Question_Model__setTopics__Test extends PHPUnit\Framework\TestCase
{
    public function test__setTopics__Base()
    {
        $question = new Question_Model();
        $question->setTopics(["iPhone 8","Apple"]);

        $this->assertEquals('["iPhone 8","Apple"]', $question->getTopicsJSON());
        $this->assertEquals(["iPhone 8","Apple"], $question->getTopics());
    }

    public function test__setTopics__Empty()
    {
        $question = new Question_Model();
        $question->setTopics([]);

        $this->assertEquals(null, $question->getTopicsJSON());
        $this->assertEquals([], $question->getTopics());
    }
}
