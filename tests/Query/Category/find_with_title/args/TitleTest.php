<?php

namespace Test\Query\Category\findWithTitle;

use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    public function test__Category_title_is_empty()
    {
        $this->expectExceptionMessage('Category title param "" must have a length between 2 and 127');
        $question = (new \Query\Category('ru'))->findWithTitle('');
    }

    public function test__Category_title_too_short()
    {
        $this->expectExceptionMessage('Category title param "x" must have a length between 2 and 127');
        $question = (new \Query\Category('ru'))->findWithTitle('x');
    }
}
