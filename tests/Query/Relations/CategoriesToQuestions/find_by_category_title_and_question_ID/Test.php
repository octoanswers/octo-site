<?php

class Query_Relations_CategoriesToQuestions__find_by_category_title_and_question_IDTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['categories', 'er_categories_questions']];

    public function test__Relation_exists()
    {
        $er = (new \Query\Relations\CategoriesToQuestions('ru'))->find_by_category_title_and_question_ID('птицы', 22);

        $this->assertEquals(21, $er->id);
        $this->assertEquals(13, $er->categoryID);
        $this->assertEquals(22, $er->questionID);
    }

    public function test__Relation_not_exists()
    {
        $er = (new \Query\Relations\CategoriesToQuestions('ru'))->find_by_category_title_and_question_ID('tagnotexists', 12);

        $this->assertEquals(null, $er);
    }
}
