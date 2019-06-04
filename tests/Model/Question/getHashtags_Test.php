<?php

class Question_Model_getCategoriesTest extends PHPUnit\Framework\TestCase
{
    public function test_Get_categories()
    {
        $question = new Question_Model();
        $question->categoriesJSON = '["iPhone8","Apple"]';

        $categories = $question->getCategories();

        $this->assertEquals(2, count($categories));
        $this->assertEquals("iPhone8", $categories[0]->title);
    }

    public function test_Get_categories_from_empty_categoriesJSON()
    {
        $question = new Question_Model();
        $question->categoriesJSON = '';

        $categories = $question->getCategories();

        $this->assertEquals(0, count($categories));
    }
    
    public function test_Get_categories_from_NULL_categoriesJSON()
    {
        $question = new Question_Model();

        $categories = $question->getCategories();

        $this->assertEquals(0, count($categories));
    }
}
