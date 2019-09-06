<?php

class Query_Relations_CategoriesToQuestions__find_by_category_ID_and_question_IDTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_categories_questions']];

    public function test__Relation_exists()
    {
        $er = (new CategoriesToQuestions_Relations_Query('ru'))->find_by_category_ID_and_question_ID(58, 19);

        $this->assertEquals(14, $er->id);
        $this->assertEquals(58, $er->categoryID);
        $this->assertEquals(19, $er->questionID);
    }

    public function test__Relation_not_exists()
    {
        $er = (new CategoriesToQuestions_Relations_Query('ru'))->find_by_category_ID_and_question_ID(3, 33);

        $this->assertEquals(null, $er);
    }
}
