<?php

class Model_Answer_timestamp_Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $answer = new Answer_Model();
        $answer->setUpdatedAt('2016-03-19 06:47:41');

        $this->assertEquals('2016-03-19 06:47:41', $answer->getUpdatedAt());
    }
}
