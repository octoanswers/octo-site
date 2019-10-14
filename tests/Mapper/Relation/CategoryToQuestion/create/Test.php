<?php

namespace Test\Mapper\Relation\CategoryToQuestion\create;

class Test extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_categories_questions']];

    public function test__Create_with_full_args()
    {
        $er = new \Model\Relation\CategoriesToQuestions();
        $er->categoryID = 3;
        $er->questionID = 9;

        $er = (new \Mapper\Relation\CategoryToQuestion('ru'))->create($er);

        $this->assertEquals(25, $er->id);
        $this->assertEquals(3, $er->categoryID);
        $this->assertEquals(9, $er->questionID);
    }
}
