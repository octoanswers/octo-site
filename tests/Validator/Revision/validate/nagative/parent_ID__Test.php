<?php

class Validator_Revision__validate__negative__parent_IDTest extends PHPUnit\Framework\TestCase
{
    public function test__Parent_ID_equal_zero()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->parentID = 0;

        $this->expectExceptionMessage('Revision parentID param 0 must be greater than or equal to 1');
        Revision_Validator::validate($revision);
    }

    public function test__Parent_ID_below_zero()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Ответ на вопрос про птиц.';
        $revision->parentID = -1;

        $this->expectExceptionMessage('Revision parentID param -1 must be greater than or equal to 1');
        Revision_Validator::validate($revision);
    }
}
