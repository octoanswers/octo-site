<?php

class Validator_Revision__baseText_Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseTextEqualNull()
    {
        $revision = new Revision_Model();
        $revision->answerID = 11;
        $revision->opcodes = 'xyz';
        $revision->userID = 14;

        $this->assertEquals(true, Revision_Validator::validate($revision));
    }
}
