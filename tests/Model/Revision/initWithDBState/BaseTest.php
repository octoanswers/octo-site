<?php

class Model_Revision_initWithDBState_Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $revision = Revision_Model::initWithDBState([
            'rev_id' => 13,
            'rev_answer_id' => 11,
            'rev_opcodes' => 'opCodes',
            'rev_base_text' => 'Ответ на вопрос про птиц.',
            'rev_comment' => 'Rev comment',
            'rev_parent_id' => 2,
            'rev_user_id' => 14,
            'rev_created_at' => '2015-12-16 13:28:56',
        ]);

        $this->assertEquals(13, $revision->getID());
        $this->assertEquals(11, $revision->getAnswerID());
        $this->assertEquals('opCodes', $revision->getOpcodes());
        $this->assertEquals('Ответ на вопрос про птиц.', $revision->getBaseText());
        $this->assertEquals('Rev comment', $revision->getComment());
        $this->assertEquals(2, $revision->getParentID());
        $this->assertEquals(14, $revision->getUserID());
        $this->assertEquals('2015-12-16 13:28:56', $revision->createdAt);
    }

    public function testMinParams()
    {
        $revision = Revision_Model::initWithDBState([
            'rev_id' => 13,
            'rev_answer_id' => 11,
            'rev_opcodes' => 'opCodes',
            'rev_base_text' => 'Ответ на вопрос про птиц.',
            'rev_comment' => null,
            'rev_parent_id' => null,
            'rev_user_id' => 14,
            'rev_created_at' => '2015-12-16 13:28:56',
        ]);

        $this->assertEquals(13, $revision->getID());
        $this->assertEquals(11, $revision->getAnswerID());
        $this->assertEquals('opCodes', $revision->getOpcodes());
        $this->assertEquals('Ответ на вопрос про птиц.', $revision->getBaseText());
        $this->assertEquals(null, $revision->getComment());
        $this->assertEquals(null, $revision->getParentID());
        $this->assertEquals(14, $revision->getUserID());
        $this->assertEquals('2015-12-16 13:28:56', $revision->createdAt);
    }
}
