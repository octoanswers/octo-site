<?php

namespace Test\Query\Relations\CategoriesToQuestions\find_newest_for_category_with_ID;

use PHPUnit\Framework\TestCase;

class PerPageTest extends TestCase
{
    public function test__PerPage_param_equal_zero()
    {
        $this->expectExceptionMessage('Questions list perPage param 0 must be greater than or equal to 5');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->find_newest_for_category_with_ID(13, 1, 0);
    }

    public function test__PerPage_param_below_zero()
    {
        $this->expectExceptionMessage('Questions list perPage param -1 must be greater than or equal to 5');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->find_newest_for_category_with_ID(13, 1, -1);
    }

    public function test__PerPage_param_below_min_value()
    {
        $this->expectExceptionMessage('Questions list perPage param 4 must be greater than or equal to 5');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->find_newest_for_category_with_ID(13, 1, 4);
    }

    public function test__PerPage_param_greater_than_100()
    {
        $this->expectExceptionMessage('Questions list perPage param 101 must be less than or equal to 100');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->find_newest_for_category_with_ID(13, 1, 101);
    }
}
