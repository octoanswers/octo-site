<?php

class Category_initWithTitleTest extends PHPUnit\Framework\TestCase
{
    public function test_Init_with_title()
    {
        $category = Category_Model::initWithTitle('common_questions');

        $this->assertEquals('common_questions', $category->title);
        $this->assertEquals(null, $category->id);
    }

    public function test_Init_with_title_on_Russian()
    {
        $category = Category_Model::initWithTitle('проливной_дождь');

        $this->assertEquals('проливной_дождь', $category->title);
        $this->assertEquals(null, $category->id);
    }
}
