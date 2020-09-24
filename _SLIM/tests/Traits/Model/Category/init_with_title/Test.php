<?php

namespace Test\Traits\Model\Category\init_with_title;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__initWithTitle()
    {
        $category = \Model\Category::initWithTitle('common_questions');

        $this->assertEquals('common_questions', $category->title);
        $this->assertEquals(null, $category->id);
    }

    public function test__Init_with_title_on_Russian()
    {
        $category = \Model\Category::initWithTitle('проливной_дождь');

        $this->assertEquals('проливной_дождь', $category->title);
        $this->assertEquals(null, $category->id);
    }
}
