<?php

class Trait_Model_Relation_CategoriesQuestions__init_with_category_ID_and_question_ID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = \Model\Relation\CategoriesToQuestions::init_with_category_ID_and_question_ID(3, 9);

        $this->assertEquals(null, $rel->id);
        $this->assertEquals(3, $rel->categoryID);
        $this->assertEquals(9, $rel->questionID);
        $this->assertEquals(null, $rel->createdAt);
    }
}
