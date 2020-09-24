<?php

namespace Test\Query\Relations\CategoriesToQuestions\findByCategoryIDAndQuestionID;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_categories_questions']];

    public function test__Relation_exists()
    {
        $er = (new \Query\Relations\CategoriesToQuestions('ru'))->findByCategoryIDAndQuestionID(58, 19);

        $this->assertEquals(14, $er->id);
        $this->assertEquals(58, $er->categoryID);
        $this->assertEquals(19, $er->questionID);
    }

    public function test__Relation_not_exists()
    {
        $er = (new \Query\Relations\CategoriesToQuestions('ru'))->findByCategoryIDAndQuestionID(3, 33);

        $this->assertEquals(null, $er);
    }
}
