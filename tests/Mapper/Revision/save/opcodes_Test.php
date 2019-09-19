<?php

use PHPUnit\Framework\TestCase;

class Mapper_Revisions__save__opcodes__Test extends TestCase
{
    public function test__OpcodesNotSet()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->baseText = 'Answer written at 19:33';

        $this->expectExceptionMessage('Revision opcodes param null must be a string');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }

    // public function test__OpcodesNotString()
    // {
    //     $revision = new \Model\Revision();
    //     $revision->answerID = 11;
    //     $revision->opcodes = 123;
    //     $revision->baseText = 'Answer written at 19:33';
    //
    //     $this->expectExceptionMessage('Revision opcodes param 123 must be a string');
    //     $revision = (new Revision_Mapper())->save($revision);
    // }

    public function test__OpcodesIsEmpty()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = '';
        $revision->baseText = 'Answer written at 19:33';

        $this->expectExceptionMessage('Revision opcodes param "" must have a length greater than 2');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }

    public function test__OpcodesTooShort()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = 's';
        $revision->baseText = 'Answer written at 19:33';
        $revision->comment = 's';

        $this->expectExceptionMessage('Revision opcodes param "s" must have a length greater than 2');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }
}
