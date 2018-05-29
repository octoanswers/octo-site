<?php

class Mapper_Revisions_New_BaseTest extends Abstract_DB_TestCase
{
    protected $setUpDB = ['ru' => ['revisions']];

    public function testSaveNewRevisionWithFullParams()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('abc');
        $revision->setBaseText('Answer written at 14:22');
        $revision->setComment('Rev comment');
        $revision->setParentID(4);
        $revision->setUserID(54);

        $revision = (new Revision_Mapper('ru'))->save($revision);

        $this->assertEquals(8, $revision->getID());
        $this->assertEquals(11, $revision->getAnswerID());
        $this->assertEquals('abc', $revision->getOpcodes());
        $this->assertEquals('Answer written at 14:22', $revision->getBaseText());
        $this->assertEquals('Rev comment', $revision->getComment());
        $this->assertEquals(4, $revision->getParentID());
        $this->assertEquals(54, $revision->getUserID());
    }

    public function testSaveNewRevisionWithMinParams()
    {
        $revision = new Revision_Model();
        $revision->setAnswerID(11);
        $revision->setOpcodes('abc');
        $revision->setBaseText('Answer written at 14:25');
        $revision->setUserID(54);

        $actualResponse = (new Revision_Mapper('ru'))->save($revision);

        $this->assertEquals(8, $revision->getID());
        $this->assertEquals(11, $revision->getAnswerID());
        $this->assertEquals('abc', $revision->getOpcodes());
        $this->assertEquals('Answer written at 14:25', $revision->getBaseText());
        $this->assertEquals(54, $revision->getUserID());
    }

    public function testUpdateRevisionWithFullParams()
    {
        $revision = new Revision_Model();
        $revision->setID(5);
        $revision->setAnswerID(11);
        $revision->setOpcodes('abc');
        $revision->setBaseText('Answer written at 19:33');
        $revision->setComment('Rev comment');
        $revision->setParentID(4);
        $revision->setUserID(54);

        $revision = (new Revision_Mapper('ru'))->save($revision);

        $this->assertEquals(5, $revision->getID());
        $this->assertEquals(11, $revision->getAnswerID());
        $this->assertEquals('abc', $revision->getOpcodes());
        $this->assertEquals('Answer written at 19:33', $revision->getBaseText());
        $this->assertEquals('Rev comment', $revision->getComment());
        $this->assertEquals(4, $revision->getParentID());
        $this->assertEquals(54, $revision->getUserID());
    }

    public function testUpdateRevisionWithMinParams()
    {
        $revision = new Revision_Model();
        $revision->setID(5);
        $revision->setAnswerID(11);
        $revision->setOpcodes('abc');
        $revision->setBaseText('Answer written at 14:25');
        $revision->setUserID(54);

        $actualResponse = (new Revision_Mapper('ru'))->save($revision);

        $this->assertEquals(5, $revision->getID());
        $this->assertEquals(11, $revision->getAnswerID());
        $this->assertEquals('abc', $revision->getOpcodes());
        $this->assertEquals('Answer written at 14:25', $revision->getBaseText());
        $this->assertEquals(54, $revision->getUserID());
    }
}
