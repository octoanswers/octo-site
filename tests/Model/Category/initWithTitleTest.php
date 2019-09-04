<?php

class Category_init_with_titleTest extends PHPUnit\Framework\TestCase
{
    public function test_Init_with_title()
    {
        $category = Category_Model::init_with_title('common_questions');

        $this->assertEquals('common_questions', $category->title);
        $this->assertEquals(null, $category->id);
    }

    public function test_Init_with_title_on_Russian()
    {
        $category = Category_Model::init_with_title('проливной_дождь');

        $this->assertEquals('проливной_дождь', $category->title);
        $this->assertEquals(null, $category->id);
    }
}
