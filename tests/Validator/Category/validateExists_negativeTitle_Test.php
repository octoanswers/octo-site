<?php

class Validator_Category_validateExists_negativeTitleTest extends PHPUnit\Framework\TestCase
{
    public function test_Exception_when_category_title_not_set()
    {
        $category = new Category();
        $category->id = 13;

        $this->expectExceptionMessage('Category title param null must be a string');
        $this->assertEquals(true, Category_Validator::validateExists($category));
    }

    public function test_Exception_when_category_title_is_empty()
    {
        $category = new Category();
        $category->id = 13;
        $category->title = '';

        $this->expectExceptionMessage('Category title param "" must have a length between 2 and 127');
        $this->assertEquals(true, Category_Validator::validateExists($category));
    }

    public function test_Exception_when_category_title_too_short()
    {
        $category = new Category();
        $category->id = 13;
        $category->title = 'x';

        $this->expectExceptionMessage('Category title param "x" must have a length between 2 and 127');
        $this->assertEquals(true, Category_Validator::validateExists($category));
    }

    public function test_Exception_when_category_title_too_long()
    {
        $category = new Category();
        $category->id = 13;
        $category->title = 'title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title';

        $this->expectExceptionMessage('Category title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $this->assertEquals(true, Category_Validator::validateExists($category));
    }
}
