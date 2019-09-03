<?php

class Query_Categories__categories_for_question_with_ID__en_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['en' => ['categories', 'er_categories_questions']];

    public function test_Question_have_one_category()
    {
        $categories = (new Categories_Query('en'))->categories_for_question_with_ID(22);

        $this->assertEquals(1, count($categories));

        $this->assertEquals(13, $categories[0]->id);
        $this->assertEquals('Birds', $categories[0]->title);
    }

    public function test_Question_dont_havecategories()
    {
        $categories = (new Categories_Query('en'))->categories_for_question_with_ID(5);

        $this->assertEquals(0, count($categories));
    }
}
