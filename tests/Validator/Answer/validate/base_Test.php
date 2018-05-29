<?php

class Validator_Answer_validate_base_Test extends PHPUnit\Framework\TestCase
{
    public function test_fullParams()
    {
        $answer = new Answer_Model();
        $answer->setID(4);
        $answer->setText('Answer written at 08:04');
        $answer->setUpdatedAt('2016-03-19 06:47:41');

        $this->assertEquals(true, Answer_Validator::validate($answer));
    }

    public function test_minParams()
    {
        $answer = new Answer_Model();
        $answer->setID(214);
        $answer->setText('Answer written at 08:04');

        $this->assertEquals(true, Answer_Validator::validate($answer));
    }
}
