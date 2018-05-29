<?php

class Model_Answer_text_Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $answer = new Answer_Model();
        $answer->setText('Boris Britva');

        $this->assertEquals('Boris Britva', $answer->getText());
    }
}
