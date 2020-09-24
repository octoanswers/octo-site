<?php

namespace Test\Query\Category\categoryWithID;

use PHPUnit\Framework\TestCase;

class IDTest extends TestCase
{
    public function test__Category_ID_equal_zero()
    {
        $this->expectExceptionMessage('Category id param 0 must be greater than or equal to 1');
        $question = (new \Query\Category('ru'))->categoryWithID(0);
    }

    public function test__Negative_category_ID()
    {
        $this->expectExceptionMessage('Category id param -1 must be greater than or equal to 1');
        $question = (new \Query\Category('ru'))->categoryWithID(-1);
    }
}
