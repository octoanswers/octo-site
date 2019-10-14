<?php

namespace Test\Mapper\Revision\save;

use PHPUnit\Framework\TestCase;

class IDTest extends TestCase
{
    protected $setUpDB = ['ru' => ['revisions']];

    public function testIDEqualZero()
    {
        $revision = new \Model\Revision();
        $revision->id = 0;
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';

        $this->expectExceptionMessage('Revision id param 0 must be greater than or equal to 1');
        $revision = (new \Mapper\Revision('ru'))->save($revision);
    }

    public function testIDBelowZero()
    {
        $revision = new \Model\Revision();
        $revision->id = -1;
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';

        $this->expectExceptionMessage('Revision id param -1 must be greater than or equal to 1');
        $revision = (new \Mapper\Revision('ru'))->save($revision);
    }
}
