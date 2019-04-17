<?php

class Validator_Answer_text_Test extends PHPUnit\Framework\TestCase
{
    public function test_empty()
    {
        $answer = new Answer_Model();
        $answer->setID(4);
        $answer->text = '';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer text param "" must have a length greater than 1');
        Answer_Validator::validate($answer);
    }
}
