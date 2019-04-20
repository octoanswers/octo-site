<?php

use PHPUnit\Framework\TestCase;

class Mapper_Answer_update_text_Test extends TestCase
{
    public function test_TextNotSet_Ok()
    {
        $answer = new Answer_Model();
        $answer->id = 18;
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer text param null must be a string');
        $answer = (new Answer_Mapper('ru'))->update($answer);
    }

    public function test_TextIsEmpty_Ok()
    {
        $answer = new Answer_Model();
        $answer->id = 18;
        $answer->text = '';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer text param "" must have a length greater than 1');
        $answer = (new Answer_Mapper('ru'))->update($answer);
    }
}
