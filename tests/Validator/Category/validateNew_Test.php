<?php

class Validator_Category_validateNewTest extends PHPUnit\Framework\TestCase
{
    public function test_One_word_category()
    {
        $category = new Category_Model();
        $category->title = 'Apple';

        $this->assertEquals(true, Category_Validator::validateNew($category));
    }

    public function test_Two_word_category()
    {
        $category = new Category_Model();
        $category->title = 'iPhone 8';

        $this->assertEquals(true, Category_Validator::validateNew($category));
    }

    public function test_Category_with_underscore()
    {
        $category = new Category_Model();
        $category->title = 'my_category';

        $this->assertEquals(true, Category_Validator::validateNew($category));
    }
}
