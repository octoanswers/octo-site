<?php

namespace Test\Query\Categories\categoriesForQuestionWithID;

class EnTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['en' => ['categories', 'er_categories_questions']];

    public function test__Question_have_one_category()
    {
        $categories = (new \Query\Categories('en'))->categoriesForQuestionWithID(22);

        $this->assertEquals(1, count($categories));

        $this->assertEquals(13, $categories[0]->id);
        $this->assertEquals('Birds', $categories[0]->title);
    }

    public function test__Question_dont_havecategories()
    {
        $categories = (new \Query\Categories('en'))->categoriesForQuestionWithID(5);

        $this->assertEquals(0, count($categories));
    }
}
