<?php

class Validator_Answer_validate_base_Test extends PHPUnit\Framework\TestCase
{
    public function test_fullParams()
    {
        $answer = new Answer_Model();
        $answer->id = 4;
        $answer->text = 'Answer written at 08:04';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->assertEquals(true, Answer_Validator::validate($answer));
    }

    public function test_minParams()
    {
        $answer = new Answer_Model();
        $answer->id = 214;
        $answer->text = 'Answer written at 08:04';

        $this->assertEquals(true, Answer_Validator::validate($answer));
    }
}
