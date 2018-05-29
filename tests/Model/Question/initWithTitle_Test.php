<?php

class Model_Question__initWithTitle__Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $question = Question_Model::initWithTitle('This is question?');

        $this->assertEquals('This is question?', $question->getTitle());
        $this->assertEquals(null, $question->getID());
        $this->assertEquals(false, $question->isRedirect());
    }

    public function testRuTitle()
    {
        $question = Question_Model::initWithTitle('Когда закончится дождь?');

        $this->assertEquals('Когда закончится дождь?', $question->getTitle());
        $this->assertEquals(null, $question->getID());
        $this->assertEquals(false, $question->isRedirect());
    }
}
