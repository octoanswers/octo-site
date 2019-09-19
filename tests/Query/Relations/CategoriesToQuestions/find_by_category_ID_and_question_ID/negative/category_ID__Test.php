<?php

use PHPUnit\Framework\TestCase;

class Query_Relations_CategoriesToQuestions__find_by_category_ID_and_question_ID__category_IDTest extends TestCase
{
    public function test__Category_ID_equal_zero()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "categoryID" property 0 must be greater than or equal to 1');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->find_by_category_ID_and_question_ID(0, 1);
    }

    public function test__Category_ID_below_zero()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "categoryID" property -1 must be greater than or equal to 1');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->find_by_category_ID_and_question_ID(-1, 1);
    }
}
