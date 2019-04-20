<?php

class Validator__Relation__HashtagToQuestion__fail__id_Test extends PHPUnit\Framework\TestCase
{
    public function test_IDEqualZero()
    {
        $rel = new HashtagsToQuestions_Relation_Model();
        $rel->id = 0;
        $rel->hashtagID = 3;
        $rel->questionID = 9;

        $this->expectExceptionMessage('HashtagToQuestion relation "id" property 0 must be greater than or equal to 1');
        HashtagToQuestion_Relation_Validator::validateExists($rel);
    }

    public function test__IDBelowZero()
    {
        $rel = new HashtagsToQuestions_Relation_Model();
        $rel->id = -1;
        $rel->hashtagID = 3;
        $rel->questionID = 9;

        $this->expectExceptionMessage('HashtagToQuestion relation "id" property -1 must be greater than or equal to 1');
        HashtagToQuestion_Relation_Validator::validateExists($rel);
    }
}
