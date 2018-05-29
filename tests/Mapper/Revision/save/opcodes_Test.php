<?php

use PHPUnit\Framework\TestCase;

class Mapper_Revisions__save__opcodes__Test extends TestCase
{
    public function test__OpcodesNotSet()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setBaseText('Answer written at 19:33');

        $this->expectExceptionMessage('Revision opcodes param null must be a string');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }

    // public function test__OpcodesNotString()
    // {
    //     $revision = new Revision_Model();
    //     $revision->setAnswerID(11);
    //     $revision->setOpcodes(123);
    //     $revision->setBaseText('Answer written at 19:33');
    //
    //     $this->expectExceptionMessage('Revision opcodes param 123 must be a string');
    //     $revision = (new Revision_Mapper())->save($revision);
    // }

    public function test__OpcodesIsEmpty()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('');
        $revision->setBaseText('Answer written at 19:33');

        $this->expectExceptionMessage('Revision opcodes param "" must have a length greater than 2');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }

    public function test__OpcodesTooShort()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('s');
        $revision->setBaseText('Answer written at 19:33');
        $revision->setComment('s');

        $this->expectExceptionMessage('Revision opcodes param "s" must have a length greater than 2');
        $revision = (new Revision_Mapper('ru'))->save($revision);
    }
}
