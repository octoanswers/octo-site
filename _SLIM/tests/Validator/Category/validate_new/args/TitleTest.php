<?php

namespace Test\Validator\Category\validateNew;

class TitleTest extends \PHPUnit\Framework\TestCase
{
    public function test__Exception_when_title_not_set()
    {
        $category = new \Model\Category();

        $this->expectExceptionMessage('Category title param null must be a string');
        $this->assertEquals(true, \Validator\Category::validateNew($category));
    }

    public function test__Exception_when_title_is_empty()
    {
        $category = new \Model\Category();
        $category->title = '';

        $this->expectExceptionMessage('Category title param "" must have a length between 2 and 127');
        $this->assertEquals(true, \Validator\Category::validateNew($category));
    }

    public function test__Exception_when_title_too_long()
    {
        $category = new \Model\Category();
        $category->id = 13;
        $category->title = 'title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title';

        $this->expectExceptionMessage('Category title param "title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title_42_title" must have a length between 2 and 127');
        $this->assertEquals(true, \Validator\Category::validateExists($category));
    }
}
