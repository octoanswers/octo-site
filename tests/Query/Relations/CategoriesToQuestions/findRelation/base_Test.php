<?php

class CategoriesToQuestions_Relations_Query__findByCategoryIDAndQuestionID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_categories_questions']];

    public function test__RelationExists()
    {
        $er = (new CategoriesToQuestions_Relations_Query('ru'))->findByCategoryIDAndQuestionID(58, 19);

        $this->assertEquals(14, $er->id);
        $this->assertEquals(58, $er->categoryID);
        $this->assertEquals(19, $er->questionID);
    }

    public function test__RelationNotExists()
    {
        $er = (new CategoriesToQuestions_Relations_Query('ru'))->findByCategoryIDAndQuestionID(3, 33);

        $this->assertEquals(null, $er);
    }
}
