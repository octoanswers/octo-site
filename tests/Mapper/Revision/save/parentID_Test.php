<?php

use PHPUnit\Framework\TestCase;

class Mapper_Revisions_New_NegativeParentIDTest extends TestCase
{
    public function testParentIDEqualZero()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('abc');
        $revision->setBaseText('Answer written at 14:22');
        $revision->setParentID(0);

        $this->expectExceptionMessage('Revision parentID param 0 must be greater than or equal to 1');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }

    public function testParentIDBelowZero()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('abc');
        $revision->setBaseText('Answer written at 14:22');
        $revision->setParentID(-1);

        $this->expectExceptionMessage('Revision parentID param -1 must be greater than or equal to 1');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }
}
