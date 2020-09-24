<?php

namespace Test\Query\Relations\CategoriesToQuestions\findByCategoryTitleAndQuestionID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['categories', 'er_categories_questions']];

    public function test__Relation_exists()
    {
        $er = (new \Query\Relations\CategoriesToQuestions('ru'))->findByCategoryTitleAndQuestionID('птицы', 22);

        $this->assertEquals(21, $er->id);
        $this->assertEquals(13, $er->categoryID);
        $this->assertEquals(22, $er->questionID);
    }

    public function test__Relation_not_exists()
    {
        $er = (new \Query\Relations\CategoriesToQuestions('ru'))->findByCategoryTitleAndQuestionID('tagnotexists', 12);

        $this->assertEquals(null, $er);
    }
}
