<?php

use PHPUnit\Framework\TestCase;

class Category_Query__categoryWithID__categoryID__Test extends TestCase
{
    public function test_CategoryIDEqualZero_ThrowsException()
    {
        $this->expectExceptionMessage('Category id param 0 must be greater than or equal to 1');
        $question = (new Category_Query('ru'))->categoryWithID(0);
    }

    public function test_CategoryIDNegative_ThrowsException()
    {
        $this->expectExceptionMessage('Category id param -1 must be greater than or equal to 1');
        $question = (new Category_Query('ru'))->categoryWithID(-1);
    }
}
