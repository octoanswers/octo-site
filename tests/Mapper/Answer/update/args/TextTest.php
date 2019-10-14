<?php

namespace Test\Mapper\Answer\update;

use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    public function test__Text_not_set()
    {
        $answer = new \Model\Answer();
        $answer->id = 18;
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer text param null must be a string');
        $answer = (new \Mapper\Answer('ru'))->update($answer);
    }

    public function test__Text_is_empty()
    {
        $answer = new \Model\Answer();
        $answer->id = 18;
        $answer->text = '';
        $answer->updatedAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('Answer text param "" must have a length greater than 1');
        $answer = (new \Mapper\Answer('ru'))->update($answer);
    }
}
