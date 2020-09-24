<?php

namespace Test\Query\Relations\CategoriesToQuestions\findNewestForCategoryWithID;

use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    public function test__Page_param_equal_zero()
    {
        $this->expectExceptionMessage('Questions list page param 0 must be greater than or equal to 1');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->findNewestForCategoryWithID(13, 0);
    }

    public function test__Page_param_below_zero()
    {
        $this->expectExceptionMessage('Questions list page param -1 must be greater than or equal to 1');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->findNewestForCategoryWithID(13, -1);
    }

    public function test__Page_param_greater_than_9999()
    {
        $this->expectExceptionMessage('Questions list page param 10000 must be less than or equal to 9999');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->findNewestForCategoryWithID(13, 10000);
    }
}
