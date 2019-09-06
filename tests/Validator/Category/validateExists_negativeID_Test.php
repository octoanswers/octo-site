<?php

class Validator_Category_validate_exists_negativeIDTest extends PHPUnit\Framework\TestCase
{
    public function test_Exception_when_category_ID_equal_zero()
    {
        $category = new Category_Model();
        $category->id = 0;
        $category->title = 'iPhone 8';

        $this->expectExceptionMessage('Category id param 0 must be greater than or equal to 1');
        Category_Validator::validate_exists($category);
    }

    public function test_Exception_when_category_ID_below_zero()
    {
        $category = new Category_Model();
        $category->id = -1;
        $category->title = 'iPhone 8';

        $this->expectExceptionMessage('Category id param -1 must be greater than or equal to 1');
        Category_Validator::validate_exists($category);
    }
}
