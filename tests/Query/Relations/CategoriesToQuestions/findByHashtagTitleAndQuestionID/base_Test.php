<?php

class Query_ER_CategoriesQuestions__find_by_category_title_and_question_ID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories', 'er_categories_questions']];

    public function test__RelationExists()
    {
        $er = (new CategoriesToQuestions_Relations_Query('ru'))->find_by_category_title_and_question_ID('птицы', 22);

        $this->assertEquals(21, $er->id);
        $this->assertEquals(13, $er->categoryID);
        $this->assertEquals(22, $er->questionID);
    }

    public function test__RelationNotExists()
    {
        $er = (new CategoriesToQuestions_Relations_Query('ru'))->find_by_category_title_and_question_ID('tagnotexists', 12);

        $this->assertEquals(null, $er);
    }
}
