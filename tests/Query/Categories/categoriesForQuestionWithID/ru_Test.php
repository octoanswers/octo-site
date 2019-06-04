<?php

class Query_Categories_categoriesForQuestionWithID_ru_Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories', 'er_categories_questions']];

    public function test_Question_have_two_categories()
    {
        $categories = (new Categories_Query('ru'))->categoriesForQuestionWithID(22);

        $this->assertEquals(2, count($categories));

        $this->assertEquals(7, $categories[0]->id);
        $this->assertEquals('Косметика', $categories[0]->title);

        $this->assertEquals(13, $categories[1]->id);
        $this->assertEquals('Птицы', $categories[1]->title);
    }

    public function test_Question_dont_havecategories()
    {
        $categories = (new Categories_Query('ru'))->categoriesForQuestionWithID(5);

        $this->assertEquals(0, count($categories));
    }
}
