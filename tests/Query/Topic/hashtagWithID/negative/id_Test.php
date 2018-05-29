<?php

use PHPUnit\Framework\TestCase;

class Topic_Query__topicWithID__topicID__Test extends TestCase
{
    public function test_TopicIDEqualZero_ThrowsException()
    {
        $this->expectExceptionMessage('Topic id param 0 must be greater than or equal to 1');
        $question = (new Topic_Query('ru'))->topicWithID(0);
    }

    public function test_TopicIDNegative_ThrowsException()
    {
        $this->expectExceptionMessage('Topic id param -1 must be greater than or equal to 1');
        $question = (new Topic_Query('ru'))->topicWithID(-1);
    }
}
