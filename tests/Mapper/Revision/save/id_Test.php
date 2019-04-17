<?php

use PHPUnit\Framework\TestCase;

class Mapper_Revisions_save_NegativeIDTest extends TestCase
{
    protected $setUpDB = ['ru' => ['revisions']];

    public function testIDEqualZero()
    {
        $revision = new Revision_Model();
        $revision->setID(0);
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';

        $this->expectExceptionMessage('Revision id param 0 must be greater than or equal to 1');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }

    public function testIDBelowZero()
    {
        $revision = new Revision_Model();
        $revision->setID(-1);
        $revision->answerID = 11;
        $revision->opcodes = 'abc';
        $revision->baseText = 'Answer written at 14:22';

        $this->expectExceptionMessage('Revision id param -1 must be greater than or equal to 1');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }
}
