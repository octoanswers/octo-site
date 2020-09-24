<?php

namespace Test\Traits\Model\Relation\CategoriesToQuestions\initWithCategoryIDAndQuestionID;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__BaseParams()
    {
        $rel = \Model\Relation\CategoriesToQuestions::initWithCategoryIDAndQuestionID(3, 9);

        $this->assertEquals(null, $rel->id);
        $this->assertEquals(3, $rel->categoryID);
        $this->assertEquals(9, $rel->questionID);
        $this->assertEquals(null, $rel->createdAt);
    }
}
