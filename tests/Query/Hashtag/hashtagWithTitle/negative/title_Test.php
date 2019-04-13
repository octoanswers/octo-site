<?php

use PHPUnit\Framework\TestCase;

class Hashtag_Query__findWithTitle__questionTitle__Test extends TestCase
{
    public function test_TopicURIIsEmpty_ThrowsException()
    {
        $this->expectExceptionMessage('Topic title param "" must have a length between 2 and 127');
        $question = (new Topic_Query('ru'))->findWithTitle('');
    }

    public function test_TopicURITooShort_ThrowsException()
    {
        $this->expectExceptionMessage('Topic title param "x" must have a length between 2 and 127');
        $question = (new Topic_Query('ru'))->findWithTitle('x');
    }
}
