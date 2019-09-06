<?php

class Validator_ER_CategoriesQuestions__validate_new__Test extends PHPUnit\Framework\TestCase
{
    public function test__FullParams__OK()
    {
        $rel = new CategoriesToQuestions_Relation_Model();
        $rel->categoryID = 3;
        $rel->questionID = 9;
        $rel->createdAt = '2015-11-29 09:28:34';

        $this->assertEquals(true, CategoryToQuestion_Relation_Validator::validate_new($rel));
    }

    public function test__MinParams__OK()
    {
        $rel = new CategoriesToQuestions_Relation_Model();
        $rel->categoryID = 3;
        $rel->questionID = 9;

        $this->assertEquals(true, CategoryToQuestion_Relation_Validator::validate_new($rel));
    }
}
