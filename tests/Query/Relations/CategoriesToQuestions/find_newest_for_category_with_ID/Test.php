<?php

class Query_Relations_CategoriesToQuestions__find_newest_for_category_with_IDTest extends \Test\TestCase\DB
{
    protected $setUpDB = ['ru' => ['er_categories_questions']];

    public function test__Find_without_params()
    {
        $relations = (new \Query\Relations\CategoriesToQuestions('ru'))->find_newest_for_category_with_ID(58);

        $this->assertEquals(10, count($relations));

        $this->assertEquals(23, $relations[0]->id);
        $this->assertEquals(58, $relations[0]->categoryID);
        $this->assertEquals(338, $relations[0]->questionID);

        $this->assertEquals(11, $relations[9]->id);
        $this->assertEquals(58, $relations[9]->categoryID);
        $this->assertEquals(1938, $relations[9]->questionID);
    }

    public function test__First_page()
    {
        $relations = (new \Query\Relations\CategoriesToQuestions('ru'))->find_newest_for_category_with_ID(58, 1);

        $this->assertEquals(10, count($relations));

        $this->assertEquals(23, $relations[0]->id);
        $this->assertEquals(58, $relations[0]->categoryID);
        $this->assertEquals(338, $relations[0]->questionID);

        $this->assertEquals(11, $relations[9]->id);
        $this->assertEquals(58, $relations[9]->categoryID);
        $this->assertEquals(1938, $relations[9]->questionID);
    }

    public function test__Second_page()
    {
        $relations = (new \Query\Relations\CategoriesToQuestions('ru'))->find_newest_for_category_with_ID(58, 2);

        $this->assertEquals(4, count($relations));

        $this->assertEquals(10, $relations[0]->id);
        $this->assertEquals(58, $relations[0]->categoryID);
        $this->assertEquals(1938, $relations[0]->questionID);

        $this->assertEquals(5, $relations[3]->id);
        $this->assertEquals(58, $relations[3]->categoryID);
        $this->assertEquals(161, $relations[3]->questionID);
    }

    public function test__Third_page()
    {
        $relations = (new \Query\Relations\CategoriesToQuestions('ru'))->find_newest_for_category_with_ID(58, 3);

        $this->assertEquals(0, count($relations));
    }
}
