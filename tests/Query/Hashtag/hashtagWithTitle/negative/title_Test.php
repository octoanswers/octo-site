<?php

use PHPUnit\Framework\TestCase;

class Hashtag_Query__findWithTitle__questionTitle__Test extends TestCase
{
    public function test_HashtagURIIsEmpty_ThrowsException()
    {
        $this->expectExceptionMessage('Hashtag title param "" must have a length between 2 and 127');
        $question = (new Hashtag_Query('ru'))->findWithTitle('');
    }

    public function test_HashtagURITooShort_ThrowsException()
    {
        $this->expectExceptionMessage('Hashtag title param "x" must have a length between 2 and 127');
        $question = (new Hashtag_Query('ru'))->findWithTitle('x');
    }
}
