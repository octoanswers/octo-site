<?php

use PHPUnit\Framework\TestCase;

class Query_ER_CategoriesQuestions__find_newest_for_category_with_ID__per_page__Test extends TestCase
{
    public function test_PerPageParamEqualZero_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param 0 must be greater than or equal to 5');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(13, 1, 0);
    }

    public function test_PerPageParamBelowZero_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param -1 must be greater than or equal to 5');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(13, 1, -1);
    }

    public function test_PerPageParamBelowMinValue_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param 4 must be greater than or equal to 5');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(13, 1, 4);
    }

    public function test_PerPageParamGreaterThan100_ThrowException()
    {
        $this->expectExceptionMessage('Questions list perPage param 101 must be less than or equal to 100');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(13, 1, 101);
    }
}
