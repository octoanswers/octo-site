<?php

class Mapper_ER_CategoriesQuestions__create__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_categories_questions']];

    public function test__FullParams__OK()
    {
        $er = new CategoriesToQuestions_Relation_Model();
        $er->categoryID = 3;
        $er->questionID = 9;

        $er = (new CategoryToQuestion_Relation_Mapper('ru'))->create($er);

        $this->assertEquals(25, $er->id);
        $this->assertEquals(3, $er->categoryID);
        $this->assertEquals(9, $er->questionID);
    }

    public function test__MinParams__OK()
    {
        $er = new CategoriesToQuestions_Relation_Model();
        $er->categoryID = 3;
        $er->questionID = 9;

        $er = (new CategoryToQuestion_Relation_Mapper('ru'))->create($er);

        $this->assertEquals(25, $er->id);
        $this->assertEquals(3, $er->categoryID);
        $this->assertEquals(9, $er->questionID);
    }
}
