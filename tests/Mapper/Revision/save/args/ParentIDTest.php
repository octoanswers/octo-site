<?php

namespace Test\Mapper\Revision\save;

use PHPUnit\Framework\TestCase;

class ParentIDTest extends TestCase
{
    public function test__Parent_ID_equal_zero()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';
        $revision->parentID = 0;

        $this->expectExceptionMessage('Revision parentID param 0 must be greater than or equal to 1');
        $revision = (new \Mapper\Revision('ru'))->save($revision);
    }

    public function test__Parent_ID_below_zero()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';
        $revision->parentID = -1;

        $this->expectExceptionMessage('Revision parentID param -1 must be greater than or equal to 1');
        $revision = (new \Mapper\Revision('ru'))->save($revision);
    }
}
