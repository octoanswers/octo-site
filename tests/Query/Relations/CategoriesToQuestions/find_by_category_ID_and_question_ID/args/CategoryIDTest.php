<?php

namespace Test\Query\Relations\CategoriesToQuestions\findByCategoryIDAndQuestionID;

use PHPUnit\Framework\TestCase;

class CategoryIDTest extends TestCase
{
    public function test__Category_ID_equal_zero()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "categoryID" property 0 must be greater than or equal to 1');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->findByCategoryIDAndQuestionID(0, 1);
    }

    public function test__Category_ID_below_zero()
    {
        $this->expectExceptionMessage('CategoryToQuestion relation "categoryID" property -1 must be greater than or equal to 1');
        $ERs = (new \Query\Relations\CategoriesToQuestions('ru'))->findByCategoryIDAndQuestionID(-1, 1);
    }
}
