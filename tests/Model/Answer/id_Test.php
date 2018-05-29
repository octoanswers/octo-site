<?php

class Model_Answer_id_Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $answer = new Answer_Model();
        $answer->setID(13);

        $this->assertEquals(13, $answer->getID());
    }
}
