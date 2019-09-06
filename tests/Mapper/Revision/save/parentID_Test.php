<?php

use PHPUnit\Framework\TestCase;

class Mapper_Revisions__save__negative__parent_ID__Test extends TestCase
{
    public function testParentIDEqualZero()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';
        $revision->parentID = 0;

        $this->expectExceptionMessage('Revision parentID param 0 must be greater than or equal to 1');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }

    public function testParentIDBelowZero()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';
        $revision->parentID = -1;

        $this->expectExceptionMessage('Revision parentID param -1 must be greater than or equal to 1');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }
}
