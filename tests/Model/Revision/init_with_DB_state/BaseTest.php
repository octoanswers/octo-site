<?php

class Model_Revision__init_with_DB_state__Test extends PHPUnit\Framework\TestCase
{
    public function testFullParams()
    {
        $revision = Revision_Model::init_with_DB_state([
            'rev_id'         => 13,
            'rev_answer_id'  => 11,
            'rev_opcodes'    => 'opCodes',
            'rev_base_text'  => 'Ответ на вопрос про птиц.',
            'rev_comment'    => 'Rev comment',
            'rev_parent_id'  => 2,
            'rev_user_id'    => 14,
            'rev_created_at' => '2015-12-16 13:28:56',
        ]);

        $this->assertEquals(13, $revision->id);
        $this->assertEquals(11, $revision->answerID);
        $this->assertEquals('opCodes', $revision->opcodes);
        $this->assertEquals('Ответ на вопрос про птиц.', $revision->baseText);
        $this->assertEquals('Rev comment', $revision->comment);
        $this->assertEquals(2, $revision->parentID);
        $this->assertEquals(14, $revision->userID);
        $this->assertEquals('2015-12-16 13:28:56', $revision->createdAt);
    }

    public function testMinParams()
    {
        $revision = Revision_Model::init_with_DB_state([
            'rev_id'         => 13,
            'rev_answer_id'  => 11,
            'rev_opcodes'    => 'opCodes',
            'rev_base_text'  => 'Ответ на вопрос про птиц.',
            'rev_comment'    => null,
            'rev_parent_id'  => null,
            'rev_user_id'    => 14,
            'rev_created_at' => '2015-12-16 13:28:56',
        ]);

        $this->assertEquals(13, $revision->id);
        $this->assertEquals(11, $revision->answerID);
        $this->assertEquals('opCodes', $revision->opcodes);
        $this->assertEquals('Ответ на вопрос про птиц.', $revision->baseText);
        $this->assertEquals(null, $revision->comment);
        $this->assertEquals(null, $revision->parentID);
        $this->assertEquals(14, $revision->userID);
        $this->assertEquals('2015-12-16 13:28:56', $revision->createdAt);
    }
}
