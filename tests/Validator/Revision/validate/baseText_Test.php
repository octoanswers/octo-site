<?php

class Validator_Revision__baseText_Test extends PHPUnit\Framework\TestCase
{
    public function test__BaseTextEqualNull()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('xyz');
        $revision->setUserID(14);

        $this->assertEquals(true, Revision_Validator::validate($revision));
    }
}
