<?php

class Model_ER_CategoriesQuestions__initWithCategoryIDAndQuestionID__Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = CategoriesToQuestions_Relation_Model::initWithCategoryIDAndQuestionID(3, 9);

        $this->assertEquals(null, $rel->id);
        $this->assertEquals(3, $rel->categoryID);
        $this->assertEquals(9, $rel->questionID);
        $this->assertEquals(null, $rel->createdAt);
    }
}
