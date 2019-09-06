<?php

use PHPUnit\Framework\TestCase;

class Mapper_Revisions__save__negative__comment__Test extends TestCase
{
    public function testCommentNotString()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 19:33';
        $revision->comment = 123;

        $this->expectExceptionMessage('Revision comment param 123 must be a string');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }

    public function testCommentIsEmpty()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 19:33';
        $revision->comment = '';

        $this->expectExceptionMessage('Revision comment param "" must have a length between 3 and 255');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }

    public function testCommentTooShort()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 19:33';
        $revision->comment = 's';

        $this->expectExceptionMessage('Revision comment param "s" must have a length between 3 and 255');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }
}
