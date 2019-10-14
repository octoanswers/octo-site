<?php

namespace Test\Validator\Revision\validate;

class AnswerIDTest extends \PHPUnit\Framework\TestCase
{
    public function test__Normal()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 4;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:39.';
        $revision->userID = 14;

        \Validator\Revision::validate($revision);

        $this->assertEquals(4, $revision->answerID);
    }

    public function test__Answer_ID_equal_zero()
    {
        $revision = new \Model\Revision();
        $revision->answerID = 0;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:39.';
        $revision->userID = 14;

        $this->expectExceptionMessage('Revision answerID param 0 must be greater than or equal to 1');
        \Validator\Revision::validate($revision);
    }

    public function test__Answer_ID_below_zero()
    {
        $revision = new \Model\Revision();
        $revision->answerID = -1;
        $revision->opcodes = 'xyz';
        $revision->baseText = 'Answer written at 11:38.';
        $revision->userID = 14;

        $this->expectExceptionMessage('Revision answerID param -1 must be greater than or equal to 1');
        \Validator\Revision::validate($revision);
    }
}
