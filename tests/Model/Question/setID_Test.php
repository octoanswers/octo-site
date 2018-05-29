<?php

class Model_Question_SetID_Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $question = new Question_Model();
        $question->setID(13);

        $this->assertEquals(13, $question->getID());
    }
}
