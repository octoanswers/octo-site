<?php

namespace Test\Validator\Category\validateExists;

class IDTest extends \PHPUnit\Framework\TestCase
{
    public function test__Exception_when_category_ID_equal_zero()
    {
        $category = new \Model\Category();
        $category->id = 0;
        $category->title = 'iPhone 8';

        $this->expectExceptionMessage('Category id param 0 must be greater than or equal to 1');
        \Validator\Category::validateExists($category);
    }

    public function test__Exception_when_category_ID_below_zero()
    {
        $category = new \Model\Category();
        $category->id = -1;
        $category->title = 'iPhone 8';

        $this->expectExceptionMessage('Category id param -1 must be greater than or equal to 1');
        \Validator\Category::validateExists($category);
    }
}
