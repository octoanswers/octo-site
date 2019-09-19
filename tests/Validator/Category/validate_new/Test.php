<?php

class Validator_Category__validate_newTest extends PHPUnit\Framework\TestCase
{
    public function test__One_word_category()
    {
        $category = new \Model\Category();
        $category->title = 'Apple';

        $this->assertEquals(true, Category_Validator::validate_new($category));
    }

    public function test__Two_word_category()
    {
        $category = new \Model\Category();
        $category->title = 'iPhone 8';

        $this->assertEquals(true, Category_Validator::validate_new($category));
    }

    public function test__Category_with_underscore()
    {
        $category = new \Model\Category();
        $category->title = 'my_category';

        $this->assertEquals(true, Category_Validator::validate_new($category));
    }
}
