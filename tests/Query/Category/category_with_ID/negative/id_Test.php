<?php

use PHPUnit\Framework\TestCase;

class Query_Category__category_with_ID__negative__categoryIDTest extends TestCase
{
    public function test__Category_ID_equal_zero()
    {
        $this->expectExceptionMessage('Category id param 0 must be greater than or equal to 1');
        $question = (new \Query\Category('ru'))->category_with_ID(0);
    }

    public function test__Negative_category_ID()
    {
        $this->expectExceptionMessage('Category id param -1 must be greater than or equal to 1');
        $question = (new \Query\Category('ru'))->category_with_ID(-1);
    }
}
