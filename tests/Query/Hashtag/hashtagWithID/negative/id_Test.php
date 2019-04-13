<?php

use PHPUnit\Framework\TestCase;

class Hashtag_Query__hashtagWithID__hashtagID__Test extends TestCase
{
    public function test_HashtagIDEqualZero_ThrowsException()
    {
        $this->expectExceptionMessage('Hashtag id param 0 must be greater than or equal to 1');
        $question = (new Hashtag_Query('ru'))->hashtagWithID(0);
    }

    public function test_HashtagIDNegative_ThrowsException()
    {
        $this->expectExceptionMessage('Hashtag id param -1 must be greater than or equal to 1');
        $question = (new Hashtag_Query('ru'))->hashtagWithID(-1);
    }
}
