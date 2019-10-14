<?php

namespace Test\Traits\Model\Relation\CategoriesToQuestions\init_with_DB_state;

class Test extends \PHPUnit\Framework\TestCase
{
    public function test__EnFullParams_ReturnObject()
    {
        $rel = \Model\Relation\CategoriesToQuestions::initWithDBState([
            'er_id'          => 13,
            'er_category_id' => 3,
            'er_question_id' => 9,
            'er_created_at'  => '2015-11-29 09:28:34',
        ]);

        $this->assertEquals(13, $rel->id);
        $this->assertEquals(3, $rel->categoryID);
        $this->assertEquals(9, $rel->questionID);
        $this->assertEquals('2015-11-29 09:28:34', $rel->createdAt);
    }

    public function test_RuFullParams_ReturnObject()
    {
        $rel = \Model\Relation\CategoriesToQuestions::initWithDBState([
            'er_id'          => 13,
            'er_category_id' => 3,
            'er_question_id' => 9,
            'er_created_at'  => '2015-11-29 09:28:34',
        ]);

        $this->assertEquals(13, $rel->id);
        $this->assertEquals(3, $rel->categoryID);
        $this->assertEquals(9, $rel->questionID);
        $this->assertEquals('2015-11-29 09:28:34', $rel->createdAt);
    }
}
