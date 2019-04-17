<?php

class Validator_Answer_timestamp_Test extends PHPUnit\Framework\TestCase
{
    public function test_timestampNotSet()
    {
        $answer = new Answer_Model();
        $answer->setID(4);
        $answer->text = 'Answer written at 08:04';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->assertEquals(true, Answer_Validator::validate($answer));
    }

    public function test_timestampIsEmpty()
    {
        $answer = new Answer_Model();
        $answer->setID(4);
        $answer->text = 'Answer written at 08:04';
        $answer->updatedAt = '';

        $this->assertEquals(true, Answer_Validator::validate($answer));
        $this->assertEquals(null, $answer->updatedAt);
    }
}
