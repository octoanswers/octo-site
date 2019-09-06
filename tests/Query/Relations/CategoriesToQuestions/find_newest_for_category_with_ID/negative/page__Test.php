<?php

use PHPUnit\Framework\TestCase;

class Query_Relations_CategoriesToQuestions__find_newest_for_category_with_ID__negative__pageTest extends TestCase
{
    public function test__Page_param_equal_zero()
    {
        $this->expectExceptionMessage('Questions list page param 0 must be greater than or equal to 1');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(13, 0);
    }

    public function test__Page_param_below_zero()
    {
        $this->expectExceptionMessage('Questions list page param -1 must be greater than or equal to 1');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(13, -1);
    }

    public function test__Page_param_greater_than_9999()
    {
        $this->expectExceptionMessage('Questions list page param 10000 must be less than or equal to 9999');
        $ERs = (new CategoriesToQuestions_Relations_Query('ru'))->find_newest_for_category_with_ID(13, 10000);
    }
}
