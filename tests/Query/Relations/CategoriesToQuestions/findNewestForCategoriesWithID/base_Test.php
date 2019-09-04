<?php

class CategoriesToQuestions_Relations_Query__find_newest_for_category_with_ID__Test extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['er_categories_questions']];

    public function test_withoutParams()
    {
        $relations = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(58);

        $this->assertEquals(10, count($relations));

        $this->assertEquals(23, $relations[0]->id);
        $this->assertEquals(58, $relations[0]->categoryID);
        $this->assertEquals(338, $relations[0]->questionID);

        $this->assertEquals(12, $relations[9]->id);
        $this->assertEquals(58, $relations[9]->categoryID);
        $this->assertEquals(33, $relations[9]->questionID);
    }

    public function test_firstPage()
    {
        $relations = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(58, 1);

        $this->assertEquals(10, count($relations));

        $this->assertEquals(23, $relations[0]->id);
        $this->assertEquals(58, $relations[0]->categoryID);
        $this->assertEquals(338, $relations[0]->questionID);

        $this->assertEquals(12, $relations[9]->id);
        $this->assertEquals(58, $relations[9]->categoryID);
        $this->assertEquals(33, $relations[9]->questionID);
    }

    public function test_secondPage()
    {
        $relations = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(58, 2);

        $this->assertEquals(5, count($relations));

        $this->assertEquals(11, $relations[0]->id);
        $this->assertEquals(58, $relations[0]->categoryID);
        $this->assertEquals(1938, $relations[0]->questionID);

        $this->assertEquals(5, $relations[4]->id);
        $this->assertEquals(58, $relations[4]->categoryID);
        $this->assertEquals(161, $relations[4]->questionID);
    }

    public function test_thirdPage()
    {
        $relations = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(58, 3);

        $this->assertEquals(0, count($relations));
    }
}
