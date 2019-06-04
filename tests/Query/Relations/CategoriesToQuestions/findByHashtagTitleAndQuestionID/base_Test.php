<?php

class Query_ER_CategoriesQuestions__findByCategoryTitleAndQuestionID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['categories', 'er_categories_questions']];

    public function test__RelationExists()
    {
        $er = (new CategoriesToQuestions_Relations_Query('ru'))->findByCategoryTitleAndQuestionID('птицы', 22);

        $this->assertEquals(21, $er->id);
        $this->assertEquals(13, $er->categoryID);
        $this->assertEquals(22, $er->questionID);
    }

    public function test__RelationNotExists()
    {
        $er = (new CategoriesToQuestions_Relations_Query('ru'))->findByCategoryTitleAndQuestionID('tagnotexists', 12);

        $this->assertEquals(null, $er);
    }
}
