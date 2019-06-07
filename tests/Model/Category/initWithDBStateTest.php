<?php

class Category_initWithDBStateTest extends PHPUnit\Framework\TestCase
{
    public function testInitWithDatabaseState()
    {
        $category = Category::initWithDBState([
            'c_id' => 13,
            'c_title' => 'virtual',
            'c_words' => 'cpu',
        ]);

        $this->assertEquals(13, $category->id);
        $this->assertEquals('virtual', $category->title);
    }

    public function testInitWithDatabaseStateOnRussian()
    {
        $category = Category::initWithDBState([
            'c_id' => 231,
            'c_title' => 'Медицинские услуги',
            'c_words' => 'таблетка',
        ]);

        $this->assertEquals(231, $category->id);
        $this->assertEquals('Медицинские услуги', $category->title);
    }

    public function testInitWithEmptyState()
    {
        $this->expectExceptionMessage('Category init with empty state');
        $category = Category::initWithDBState([]);
    }
}
