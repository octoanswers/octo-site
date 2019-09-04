<?php

use PHPUnit\Framework\TestCase;

class Query_ER_CategoriesQuestions__find_by_category_ID_and_question_ID__category_id__Test extends TestCase
{
    public function test__CategoryIDEqualZero_ThrowException()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "categoryID" property 0 must be greater than or equal to 1');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_by_category_ID_and_question_ID(0, 1);
    }

    public function test__CategoryIDBelowZero_ThrowException()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "categoryID" property -1 must be greater than or equal to 1');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_by_category_ID_and_question_ID(-1, 1);
    }
}
