<?php

namespace Test\Validator\Revision\validate;

class ParentIDTest extends \PHPUnit\Framework\TestCase
{
    public function test__Parent_ID_equal_zero()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->parentID = 0;

        $this->expectExceptionMessage('Revision parentID param 0 must be greater than or equal to 1');
        \Validator\Revision::validate($revision);
    }

    public function test__Parent_ID_below_zero()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->parentID = -1;

        $this->expectExceptionMessage('Revision parentID param -1 must be greater than or equal to 1');
        \Validator\Revision::validate($revision);
    }
}
