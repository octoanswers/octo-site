<?php

use PHPUnit\Framework\TestCase;

class Category_Query__find_with_title__questionTitle__Test extends TestCase
{
    public function test_CategoryURIIsEmpty_ThrowsException()
    {
        $this->expectExceptionMessage('Category title param "" must have a length between 2 and 127');
        $question = (new Category_Query('ru'))->find_with_title('');
    }

    public function test_CategoryURITooShort_ThrowsException()
    {
        $this->expectExceptionMessage('Category title param "x" must have a length between 2 and 127');
        $question = (new Category_Query('ru'))->find_with_title('x');
    }
}
