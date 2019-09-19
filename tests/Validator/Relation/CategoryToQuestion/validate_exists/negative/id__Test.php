<?php

class Validator_Relation_CategoryToQuestion__validate_exists__negative__IDTest extends PHPUnit\Framework\TestCase
{
    public function test__ID_equal_zero()
    {
        $rel = new \Model\Relation\CategoriesToQuestions();
        $rel->id = 0;
        $rel->categoryID = 3;
        $rel->questionID = 9;

        $this->expectExceptionMessage('CategoryToQuestion relation "id" property 0 must be greater than or equal to 1');
        \Validator\Relation\CategoryToQuestion::validate_exists($rel);
    }

    public function test__ID_below_zero()
    {
        $rel = new \Model\Relation\CategoriesToQuestions();
        $rel->id = -1;
        $rel->categoryID = 3;
        $rel->questionID = 9;

        $this->expectExceptionMessage('CategoryToQuestion relation "id" property -1 must be greater than or equal to 1');
        \Validator\Relation\CategoryToQuestion::validate_exists($rel);
    }
}
