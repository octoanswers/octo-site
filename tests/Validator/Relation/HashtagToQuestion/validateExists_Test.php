<?php

class Validator_ER_CategoryQuestions__id__Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $rel = new CategoriesToQuestions_Relation_Model();
        $rel->id = 0;
        $rel->categoryID = 3;
        $rel->questionID = 9;

        $this->expectExceptionMessage('CategoryToQuestion relation "id" property 0 must be greater than or equal to 1');
        CategoryToQuestion_Relation_Validator::validate_exists($rel);
    }

    public function test__IDBelowZero()
    {
        $rel = new CategoriesToQuestions_Relation_Model();
        $rel->id = -1;
        $rel->categoryID = 3;
        $rel->questionID = 9;

        $this->expectExceptionMessage('CategoryToQuestion relation "id" property -1 must be greater than or equal to 1');
        CategoryToQuestion_Relation_Validator::validate_exists($rel);
    }
}
