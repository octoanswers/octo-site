<?php

namespace Test\Mapper\Revision\save;

use PHPUnit\Framework\TestCase;

class AnswerIDTest extends TestCase
{
    public function testAnswerIDEqualZero()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 0;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';

        $this->expectExceptionMessage('Revision answerID param 0 must be greater than or equal to 1');
        $revision = (new \Mapper\Revision('ru'))->save($revision);
    }

    public function testAnswerIDBelowZero()
    {
        $revision = new \Model\Revision();
        $revision->answerID = -1;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';

        $this->expectExceptionMessage('Revision answerID param -1 must be greater than or equal to 1');
        $revision = (new \Mapper\Revision('ru'))->save($revision);
    }
}
