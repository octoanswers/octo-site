<?php

use PHPUnit\Framework\TestCase;

class Category_Query__find_with_title__negative__titleTest extends TestCase
{
    public function test__Category_title_is_empty()
    {
        $this->expectExceptionMessage('Category title param "" must have a length between 2 and 127');
        $question = (new Category_Query('ru'))->find_with_title('');
    }

    public function test__Category_title_too_short()
    {
        $this->expectExceptionMessage('Category title param "x" must have a length between 2 and 127');
        $question = (new Category_Query('ru'))->find_with_title('x');
    }
}
